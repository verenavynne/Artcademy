// --- IMPORT MODULES ---
import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

/**
 * @typedef {Object} MockupConfig
 * @property {string} containerId - ID elemen HTML container
 * @property {'laptop'|'mobile'} mockupType - jenis mockup
 * @property {'image'|'video'} portoType - jenis media
 * @property {string} mediaPath - path media (gambar/video)
 * @property {number} mockupSize - ukuran sisi canvas (px)
 * @property {boolean} animation - untuk kasih animati atau tidak
 */

/**
 * @param {MockupConfig} config
 */

export function initMockup(config) {
    const { containerId, mockupType, portoType, mediaPath, mockupSize, animation = false } = config;
    const container = document.getElementById(containerId);
    if (!container) {
        console.error(`Container ${containerId} tidak ditemukan`);
        return;
    }

    // Scene setup
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(mockupSize, mockupSize);
    renderer.setClearColor(0x000000, 0);
    container.appendChild(renderer.domElement);

    scene.add(new THREE.AmbientLight(0xffffff, 1.2));
    const dirLight = new THREE.DirectionalLight(0xffffff, 1);
    dirLight.position.set(1, 1, 2);
    scene.add(dirLight);

    camera.position.set(0, 0, 5);
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;

    let screenMesh = null;
    let globalVideo = null;

    // Change Mockup Screen With Image
    function applyImageTexture(child, imagePath) {
        const texture = new THREE.TextureLoader().load(imagePath, () => {
            texture.flipY = true;
            texture.encoding = THREE.sRGBEncoding;
            if (mockupType === 'laptop') {
                adjustUVTexture(child, texture);
            }

            child.material = new THREE.MeshBasicMaterial({
                map: texture,
                side: THREE.FrontSide
            });
            child.material.needsUpdate = true;
        });
    }

    // Change Mockup Screen With Video
    function applyVideoTexture(child, videoPath) {
        const video = document.createElement('video');
        video.src = videoPath;
        video.loop = true;
        video.muted = true;
        video.playsInline = true;
        video.autoplay = true;
        video.crossOrigin = 'anonymous';
        video.play();

        const videoTexture = new THREE.VideoTexture(video);
        videoTexture.flipY = true;
        videoTexture.encoding = THREE.sRGBEncoding;
        if (mockupType === 'laptop') {
            adjustUVTexture(child, videoTexture);
        }

        child.material = new THREE.MeshBasicMaterial({
            map: videoTexture,
            side: THREE.FrontSide
        });
        child.material.needsUpdate = true;
        globalVideo = video;
    }

    function adjustUVTexture(child, texture) {
        const uvs = child.geometry.attributes.uv.array;
        let minU = Infinity, maxU = -Infinity, minV = Infinity, maxV = -Infinity;

        for (let i = 0; i < uvs.length; i += 2) {
            const u = uvs[i], v = uvs[i + 1];
            if (u < minU) minU = u; if (u > maxU) maxU = u;
            if (v < minV) minV = v; if (v > maxV) maxV = v;
        }

        const uvWidth = maxU - minU;
        const uvHeight = maxV - minV;
        texture.repeat.set(1 / uvWidth, 1 / uvHeight);
        texture.offset.set(-minU / uvWidth, -minV / uvHeight);
    }

    // Load Mockup Model
    let model = null;
    const loader = new GLTFLoader();
    const modelPath = mockupType === 'laptop'
        ? '/assets/mockup/laptop.glb'
        : '/assets/mockup/iphone.glb';

    loader.load(modelPath, (gltf) => {
        model = gltf.scene;
        if (mockupType === 'laptop') {
            model.scale.set(0.5, 0.5, 0.5);
            model.position.set(0, -0.5, 0);
        } else {
            model.scale.set(18, 18, 18);
            model.rotation.y = Math.PI;
        }

        scene.add(model);

        model.traverse((child) => {
            if (!child.isMesh) return;
            const screenName = mockupType === 'laptop' ? 'Object_3' : 'xXDHkMplTIDAXLN';
            if (child.name === screenName) {
                screenMesh = child;
                if (portoType === 'video') {
                    applyVideoTexture(child, mediaPath);
                }
                else {
                    applyImageTexture(child, mediaPath);
                }
            }
        });

        animate();
    });

    
    function animate() {
        requestAnimationFrame(animate);
        if (animation && model) {
            model.rotation.y += 0.003;
        }
       
        controls.update();
        renderer.render(scene, camera);
    }

    function updateScreenTexture(file) {
        if (!screenMesh) return console.error("Screen mesh belum tersedia");
        const isVideo = file.type.startsWith("video/");
        const url = URL.createObjectURL(file);

        if (screenMesh.material.map) screenMesh.material.map.dispose();
        isVideo ? applyVideoTexture(screenMesh, url) : applyImageTexture(screenMesh, url);
        screenMesh.material.needsUpdate = true;
    }

    window[`updateScreenTexture_${containerId}`] = updateScreenTexture;
}
