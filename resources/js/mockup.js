import * as THREE from 'https://unpkg.com/three@0.161.0/build/three.module.js';
import { OrbitControls } from 'https://unpkg.com/three@0.161.0/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'https://unpkg.com/three@0.161.0/examples/jsm/loaders/GLTFLoader.js';


// cari semua container mockup di halaman
document.querySelectorAll('.mockup-container').forEach(container => {
    const containerId = container.id;
    const mockupType = container.dataset.mockupType;
    const portoType = container.dataset.portoType;
    const mediaPath = container.dataset.mediaPath;
    const mockupSize = parseInt(container.dataset.mockupSize, 10);

    initMockup(container, mockupType, portoType, mediaPath, mockupSize);
});

function initMockup(container, mockupType, portoType, mediaPath, mockupSize) {
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

    function applyImageTexture(child, imagePath) {
        
        const texture = new THREE.TextureLoader().load(imagePath, () => {
            texture.flipY = true;
            texture.encoding = THREE.sRGBEncoding;
            if (mockupType === 'laptop') {
                adjustUVTexture(child, texture);
            }
            child.material = new THREE.MeshBasicMaterial({
                map: texture,
                side: THREE.FrontSide,
                transparent: false,
                opacity: 1,
            });
            child.material.needsUpdate = true;
        });
    }

    function applyVideoTexture(child, videoPath) {
        const video = document.createElement('video');
        video.src = videoPath;
        video.crossOrigin = 'anonymous';
        video.loop = true;
        video.muted = false;
        video.playsInline = true;
        video.autoplay = true;
        video.play();

        const videoTexture = new THREE.VideoTexture(video);
        videoTexture.flipY = true;
        videoTexture.encoding = THREE.sRGBEncoding;

        if (mockupType === 'laptop') {
            adjustUVTexture(child, videoTexture);
        }

        child.material = new THREE.MeshBasicMaterial({
            map: videoTexture,
            side: THREE.FrontSide,
            transparent: false,
            opacity: 1,
        });
        child.material.needsUpdate = true;

        globalVideo = video;
    }

    // --- Fungsi bantu: hitung UV scaling & offset ---
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

    const loader = new GLTFLoader();
    const modelPath = mockupType === 'laptop'
        ? '/assets/mockup/laptop.glb'
        : '/assets/mockup/iphone.glb';

    loader.load(modelPath, (gltf) => {
        const model = gltf.scene;

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
                } else {
                    applyImageTexture(child, mediaPath);
                }
            }
        });

        animate();
    });

    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }

    // expose function ke global supaya bisa dipanggil dari luar
    window.updateScreenTexture = function (newPath) {
       if (!screenMesh) return console.error("Screen mesh belum tersedia");

        // deteksi tipe file
        const ext = newPath.split('.').pop().toLowerCase();
        const isVideo = ['mp4', 'webm', 'ogg'].includes(ext);

        // bersihkan texture lama
        if (screenMesh.material.map) {
            screenMesh.material.map.dispose();
        }

        if(isVideo){
            applyVideoTexture(screenMesh, newPath);
        }else{
            applyImageTexture(screenMesh, newPath);
        }
        screenMesh.material.needsUpdate = true;
    };

    container.addEventListener('click', () => {
        if (!globalVideo) return;
        globalVideo.paused ? globalVideo.play() : globalVideo.pause();
    });
}
