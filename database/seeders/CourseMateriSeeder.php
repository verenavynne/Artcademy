<?php

namespace Database\Seeders;

use App\Models\CourseMateri;
use App\Models\CourseWeek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseMateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materis = [
            // 🎨 SENI LUKIS & DIGITAL ART
            'Seni Lukis & Digital Art' => [
                'Minggu 1: Pengenalan Concept Art & Ideation' => [
                    [
                        'articleName' => 'Pengantar Concept Art',
                        'articleText' => 'Concept art adalah tahap awal dalam proses pembuatan visual untuk game, film, animasi, hingga komik. Pada tahap ini, seorang artist bertugas menerjemahkan ide abstrak menjadi bentuk visual yang konkret, sehingga dapat menjadi acuan bagi tim produksi. Melalui concept art, arah gaya visual, tone warna, karakter, hingga environment dapat ditentukan sejak awal sehingga seluruh tim memiliki gambaran yang konsisten. Dalam materi ini, kamu akan mempelajari fungsi inti concept art, bagaimana proses ideation dilakukan, dan apa saja keterampilan dasar yang diperlukan sebelum mulai membuat desain final.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Brainstorming Ide untuk Art',
                        'vblDesc' => 'Cara brainstorming ide secara efektif',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 20
                    ],
                    [
                        'articleName' => 'Pelajari Konsep Art dalam Film',
                        'articleText' => 'Dalam industri film, concept art memiliki peran besar dalam membangun dunia dan suasana yang ingin disampaikan kepada penonton. Concept artist bekerja sama dengan sutradara dan tim produksi untuk menentukan look & feel dari scene, karakter, dan properti penting sebelum tahap syuting dimulai. Melalui concept art, film bisa memiliki identitas visual yang kuat dan konsisten. Pada materi ini kamu akan mempelajari bagaimana film blockbuster menggunakan concept art untuk world-building, serta memahami alur kerja artist dalam sebuah produksi film.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Pelajari Konsep Art dalam Game',
                        'articleText' => 'Dalam dunia game development, concept art menjadi fondasi bagi terciptanya karakter, environment, monster, senjata, dan berbagai elemen visual lainnya. Berbeda dengan film, game membutuhkan visual yang dapat diterapkan ke dalam model 3D, animasi, dan gameplay. Concept artist harus memikirkan fungsionalitas, ergonomi, hingga bagaimana sebuah desain akan terlihat dalam berbagai sudut kamera. Melalui materi ini, kamu akan memahami bagaimana game industry memanfaatkan concept art untuk menciptakan pengalaman bermain yang imersif dan menarik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Pelajari Konsep Art dalam Lukisan',
                        'articleText' => 'Meskipun lukisan merupakan media tradisional, banyak teknik dan alur berpikir concept art dapat diterapkan ke dalam proses melukis. Seorang pelukis juga perlu memahami komposisi, lighting, gesture, dan storytelling dalam karya mereka. Materi ini akan membahas bagaimana seorang seniman dapat mengambil inspirasi dari proses concept art—seperti membuat thumbnail, eksplor warna, dan membangun mood sebelum melukis—untuk menghasilkan karya yang lebih matang dan memiliki makna visual yang kuat.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
                'Minggu 2: Desain Karakter Dasar' => [
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Proporsi Tubuh',
                        'vblDesc' => 'Pelajari dasar proporsi tubuh manusia',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Membangun Ekspresi Karakter',
                        'articleText' => 'Ekspresi wajah merupakan elemen penting dalam desain karakter karena mampu menggambarkan kepribadian, emosi, dan intensi sebuah karakter tanpa perlu kata-kata. Dalam materi ini, kamu akan belajar bagaimana memahami struktur wajah, otot ekspresi, serta bagaimana menggambarkan berbagai ekspresi mulai dari senang, sedih, marah, hingga ekspresi ekstrem. Pembelajaran ini akan membantu kamu menciptakan karakter yang lebih hidup dan relatable.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Gaya Visual Kartun',
                        'articleText' => 'Karakter kartun memiliki ciri khas seperti bentuk yang sederhana, proporsi yang dilebih-lebihkan, serta ekspresi yang kuat. Gaya ini populer karena mudah diterima penonton segala usia dan sangat fleksibel untuk kebutuhan animasi maupun ilustrasi. Dalam materi ini, kamu akan mempelajari bagaimana menyederhanakan bentuk anatomi, mengekspresikan karakter melalui siluet, dan membuat desain yang unik sekaligus mudah dikenali.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Menampilkan Emosi Karakter',
                        'articleText' => 'Emosi adalah bahasa universal yang dapat membuat penonton merasa terhubung dengan karakter. Materi ini mengajarkan teknik menggambar emosi yang kuat melalui gestur tubuh, pose, bentuk mata, hingga penggunaan garis dan warna. Kamu juga akan mempelajari bagaimana menciptakan storytelling melalui ekspresi sehingga karakter terlihat natural dan memiliki depth emosional.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Kepribadian Melalui Warna dan Bentuk',
                        'articleText' => 'Warna dan bentuk merupakan elemen visual yang sangat berpengaruh terhadap bagaimana karakter dipersepsikan. Bentuk bulat biasanya menggambarkan karakter yang lembut dan ramah, sedangkan bentuk tajam dan bersudut menunjukkan kesan tegas atau antagonis. Warna juga memainkan peran penting dalam memberikan mood kepribadian. Materi ini membahas cara memilih bentuk dan palet warna yang sesuai untuk karakter yang kamu rancang, sehingga karakter tersebut memiliki identitas visual yang kuat.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
                'Minggu 3: Environment & Props Design' => [
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Perspektif Dasar',
                        'vblDesc' => 'Dasar perspektif untuk environment design',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=SwTQUse4wCzO-v8W',
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Panduan Membuat Mood Board',
                        'articleText' => 'Mood board adalah kumpulan referensi visual yang digunakan untuk menentukan arah estetika dari suatu desain. Dalam environment design, mood board dapat berisi foto lokasi asli, sketsa, warna, tekstur, hingga gambar inspirasi dari artist lain. Materi ini akan mengajarkan cara mengumpulkan referensi yang tepat, menyusun mood board yang efektif, dan bagaimana menggunakannya sebagai panduan selama proses pembuatan environment atau props.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Speed Painting Fantasi',
                        'vblDesc' => 'Teknik speed painting dengan gaya fantasi/sci-fi',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=u0WeSLquxcywOw3J',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Prop Design Fungsional',
                        'vblDesc' => 'Merancang prop yang fungsional dan menarik secara visual',
                        'vblUrl' => 'https://youtu.be/1OW1gE_BfJY?si=u0WeSLquxcywOw3J',
                        'duration' => 10
                    ],
                ],
            ],

            // 💃 SENI TARI
            'Seni Tari' => [
                'Minggu 1: Dasar Gerak dan Irama' => [
                    [
                        'articleName' => 'Memahami Ritme dalam Gerakan',
                        'articleText' => 'Ritme adalah elemen yang menjadi dasar dari setiap gerakan tari. Tanpa pemahaman ritme yang baik, seorang penari akan kesulitan menyesuaikan gerakan tubuh dengan tempo musik. Materi ini menjelaskan bagaimana penari dapat merasakan beat, menghitung ketukan, serta menggunakan ritme sebagai panduan untuk memulai, menghentikan, atau mengubah intensitas gerak. Dengan memahami ritme, penari dapat menjaga konsistensi gerakan sehingga tarian terlihat lebih harmonis dan menyatu dengan musik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Pemanasan Penari',
                        'vblDesc' => 'Latihan dasar fleksibilitas dan kekuatan tubuh.',
                        'vblUrl' => 'https://youtu.be/11cta61wi0g?si=Pij3w4gLSC_xuqdM',
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Gerak Harmonis dengan Musik',
                        'articleText' => 'Gerak harmonis merupakan hasil dari sinkronisasi antara tubuh dan musik. Seorang penari perlu memahami bagaimana tempo, dinamika, dan aksen musik dapat memengaruhi kualitas gerakan. Dalam materi ini, kamu akan mempelajari cara menyesuaikan kecepatan gerak tubuh dengan beat musik, bagaimana merespons perubahan tempo, serta bagaimana memanfaatkan energi musik untuk memperkuat ekspresi. Latihan-latihan pada bagian ini membantu penari tampil lebih natural dan menyatu dengan alunan musik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Teknik Sinkronisasi Gerak',
                        'articleText' => 'Sinkronisasi gerak mengajarkan bagaimana agar setiap gerakan tubuh berada pada waktu yang tepat sesuai irama musik. Ini merupakan kemampuan penting baik untuk penari solo, kelompok kecil, maupun ensemble besar. Materi ini membahas pengendalian tempo internal (tempo tubuh), pemanfaatan hitungan 8-beat, serta teknik menandai aksen musik. Kamu juga akan belajar bagaimana menjaga kekompakan ketika menari bersama kelompok sehingga seluruh penari tampak bergerak secara serempak dan selaras.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
                'Minggu 2: Teknik Tari Tradisional' => [
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Tari Nusantara',
                        'vblDesc' => 'Teknik dasar tari tradisional dari berbagai daerah Indonesia.',
                        'vblUrl' => 'https://youtu.be/11cta61wi0g?si=Pij3w4gLSC_xuqdM',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Tari Saman Aceh',
                        'vblDesc' => 'Gerak cepat dan serempak khas tari tradisional Aceh.',
                        'vblUrl' => 'https://youtu.be/11cta61wi0g?si=Pij3w4gLSC_xuqdM',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Tari Modern K-Pop',
                        'vblDesc' => 'Teknik dasar koreografi modern yang dinamis dan ekspresif.',
                        'vblUrl' => 'https://youtu.be/11cta61wi0g?si=Pij3w4gLSC_xuqdM',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Tari Kontemporer Barat',
                        'vblDesc' => 'Eksplorasi gerak tari barat dengan teknik ekspresif dan improvisatif.',
                        'vblUrl' => 'https://youtu.be/11cta61wi0g?si=Pij3w4gLSC_xuqdM',
                        'duration' => 10
                    ],
                ],
                'Minggu 3: Koreografi dan Improvisasi' => [
                    [
                        'articleName' => 'Dasar Menyusun Koreografi',
                        'articleText' => 'Menyusun koreografi adalah proses kreatif yang menggabungkan ide, gerakan, ritme, dan ekspresi menjadi satu rangkaian. Materi ini menjelaskan langkah-langkah penting dalam membuat koreografi, mulai dari menentukan tema, memilih musik, merancang pola lantai, hingga menyusun alur gerakan. Kamu juga akan mempelajari bagaimana gerakan dapat dibuat bervariasi melalui dinamika, level, dan arah gerak. Dengan memahami struktur dasar koreografi, penari atau koreografer dapat menghasilkan pertunjukan yang lebih terarah dan bermakna.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Improvisasi Panggung',
                        'vblDesc' => 'Teknik improvisasi penari profesional saat tampil langsung.',
                        'vblUrl' => 'https://youtu.be/11cta61wi0g?si=Pij3w4gLSC_xuqdM',
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Struktur Gerakan Tarian',
                        'articleText' => 'Struktur gerakan membantu penari menyusun tarian yang tidak monoton dan memiliki perkembangan. Dalam materi ini, kamu akan mempelajari berbagai jenis variasi gerakan seperti repetisi, perubahan tempo, modifikasi level, serta pengembangan motif gerak. Penekanan juga diberikan pada bagaimana mengatur urutan gerakan agar tarian tetap menarik dan memiliki alur cerita yang jelas. Pemahaman ini penting untuk menciptakan koreografi yang memiliki karakter dan identitas visual yang kuat.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Alur dan Transisi Gerakan',
                        'articleText' => 'Transisi merupakan penghubung antara satu gerakan dengan gerakan berikutnya. Transisi yang halus dapat membuat penampilan terlihat natural, sedangkan transisi yang canggung dapat mengganggu alur tarian. Materi ini mengajarkan teknik transisi yang efektif, seperti memanfaatkan momentum gerakan sebelumnya, mengatur keseimbangan tubuh, serta memilih sudut gerakan yang tepat. Dengan memahami transisi, penari dapat menciptakan alur gerakan yang lebih kohesif dan nyaman dilihat.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Ekspresi dalam Koreografi',
                        'articleText' => 'Ekspresi merupakan elemen penting dalam tarian yang berfungsi menyampaikan emosi dan pesan kepada penonton. Dalam materi ini, kamu akan mempelajari bagaimana menggabungkan ekspresi wajah, postur tubuh, serta dinamika gerakan untuk memperkuat karakter tarian. Pembahasan juga mencakup bagaimana memilih ekspresi yang sesuai dengan tema dan musik, serta bagaimana mempertahankan konsistensi ekspresi sepanjang pertunjukan. Tujuannya adalah menciptakan koreografi yang tidak hanya indah secara teknis, tetapi juga menyentuh secara emosional.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
                'Minggu 4: Penampilan Akhir' => [
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Gladi Resik Pertunjukan',
                        'vblDesc' => 'Simulasi penampilan penuh di panggung.',
                        'vblUrl' => 'https://youtu.be/11cta61wi0g?si=Pij3w4gLSC_xuqdM',
                        'duration' => 10
                    ],
                ],
            ],

            // 🎵 SENI MUSIK
            'Seni Musik' => [
                'Minggu 1: Teori Musik Dasar' => [
                    [
                        'articleName' => 'Mengenal Tangga Nada',
                        'articleText' => 'Tangga nada adalah urutan nada yang tersusun secara teratur dari nada rendah menuju nada tinggi atau sebaliknya. Dalam musik, tangga nada menjadi fondasi utama yang membentuk karakter bunyi sebuah lagu. Dua jenis tangga nada yang paling umum adalah tangga nada mayor dan minor. Tangga nada mayor cenderung memiliki nuansa ceria, terang, dan optimis, sedangkan tangga nada minor lebih bernuansa sendu, lembut, atau emosional. Dengan memahami pola jarak antar nada pada setiap tangga nada, seorang pemain musik dapat dengan mudah menentukan melodi, mengiringi lagu, hingga melakukan improvisasi. Pengetahuan tentang tangga nada juga menjadi langkah awal untuk mempelajari harmoni, progresi akor, dan komposisi musik secara lebih mendalam.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Interval dan Harmoni',
                        'articleText' => 'Interval adalah jarak antara dua nada dan menjadi elemen penting dalam membentuk melodi maupun harmoni. Setiap interval memiliki karakter suara yang berbeda, seperti interval prime yang terdengar sama, interval kuint yang stabil, atau interval sekunda yang memberi rasa tegang. Dari perpaduan beberapa interval inilah harmoni tercipta. Harmoni dalam musik berfungsi memperkaya melodi utama, memberikan warna, kedalaman, dan suasana tertentu dalam lagu. Memahami interval membantu musisi mengenali bagaimana dua atau lebih nada dapat dimainkan bersama secara selaras, serta mengapa kombinasi tertentu terdengar enak atau tidak enak di telinga. Dengan menguasai interval dan harmoni, musisi dapat menyusun chord, menciptakan keselarasan suara, dan memperbaiki kemampuan mendengar (ear training).',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Chord Dasar untuk Pemula',
                        'articleText' => 'Chord atau akor adalah kumpulan tiga nada atau lebih yang dimainkan secara bersamaan untuk menghasilkan harmoni. Dalam tahap dasar, pemain musik dapat mulai mempelajari chord mayor, minor, dan diminished. Chord mayor biasanya menghasilkan suara yang cerah dan kuat, sedangkan chord minor memberikan kesan lembut atau sedih. Chord diminished memberikan nuansa misterius dan tegang. Mengenal bentuk dasar chord pada berbagai instrumen—seperti piano atau gitar—membantu musisi memahami bagaimana susunan nada membentuk harmoni yang mengiringi melodi lagu. Dengan menguasai chord dasar, pemula dapat mulai memainkan berbagai lagu sederhana serta memahami struktur harmoni yang lebih kompleks di kemudian hari.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Progresi Akor Populer',
                        'articleText' => 'Progresi akor adalah urutan chord dalam sebuah lagu dan menjadi kerangka utama yang menentukan arah musik. Salah satu progresi yang paling terkenal adalah I–V–vi–IV, yang banyak digunakan dalam lagu pop modern. Progresi ini menciptakan nuansa yang stabil, familiar, dan mudah diterima pendengar. Memahami progresi akor membantu musisi mengetahui bagaimana perpindahan chord dapat memengaruhi suasana lagu, mulai dari penuh energi, romantis, hingga melankolis. Selain itu, dengan mempelajari berbagai progresi akor populer seperti ii–V–I, vi–IV–I–V, atau I–vi–IV–V, pemusik dapat mulai membuat komposisi sederhana, melakukan improvisasi, atau menciptakan aransemen yang lebih kaya. Penguasaan progresi akor menjadi bekal penting untuk masuk ke level komposisi musik yang lebih kreatif.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Membaca Notasi Musik',
                        'articleText' => 'Membaca notasi musik atau sheet music merupakan kemampuan fundamental bagi setiap musisi. Notasi musik mencakup not balok, nilai nada, kunci (clef), tanda birama, tanda istirahat, dan berbagai simbol lainnya. Dengan memahami notasi, musisi dapat membaca melodi, ritme, dan dinamika secara tepat sesuai yang ditulis oleh komposer. Ini juga memungkinkan kolaborasi antar musisi yang memiliki latar belakang berbeda. Membaca notasi musik tidak hanya membantu dalam memainkan lagu, tetapi juga mendorong musisi berpikir lebih sistematis tentang struktur musik. Kemampuan ini menjadi jembatan penting untuk mempelajari teknik lanjutan seperti sight reading, scoring, dan transkripsi lagu.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],

                'Minggu 2: Instrumen dan Vokal' => [
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Latihan Vokal Pemula',
                        'vblDesc' => 'Latihan pernapasan dan artikulasi vokal.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Latihan Resonansi Suara',
                        'vblDesc' => 'Pelajari resonansi dan kontrol nada untuk suara yang stabil.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Teknik Pernapasan Diafragma',
                        'vblDesc' => 'Cara mengatur napas agar suara tidak mudah habis saat bernyanyi.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Latihan Vibrato dan Dinamika',
                        'vblDesc' => 'Melatih variasi suara agar lebih ekspresif.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                ],

                'Minggu 3: Komposisi dan Aransemen' => [
                    [
                        'articleName' => 'Langkah Awal Komposisi Lagu',
                        'articleText' => 'Komposisi lagu adalah proses kreatif dalam menciptakan struktur musik yang utuh. Langkah awal dalam membuat komposisi dimulai dari menemukan ide dasar atau motif, yaitu rangkaian melodi pendek yang menjadi identitas lagu. Ide ini kemudian dikembangkan menjadi frase melodi, tema, dan akhirnya menjadi bentuk yang lebih panjang. Dalam tahap ini, penting bagi pencipta lagu untuk memahami hubungan antara melodi, ritme, dan harmoni agar komposisinya terasa menyatu. Selain itu, pencipta lagu perlu menentukan tempo, suasana, dan gaya musik yang sesuai dengan karakter lagu. Proses komposisi juga melibatkan eksplorasi bunyi, eksperimen progresi chord, dan penyusunan dinamika. Dengan menguasai dasar-dasar ini, komposer pemula dapat menghasilkan karya yang lebih matang dan berkesan.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Membangun Struktur Lagu',
                        'articleText' => 'Struktur lagu adalah susunan bagian-bagian seperti intro, verse, chorus, bridge, hingga outro. Setiap bagian memiliki fungsi berbeda yang membantu membangun alur lagu agar lebih menarik. Verse biasanya berisi cerita atau detail naratif, sementara chorus merupakan bagian yang paling kuat dan mudah diingat. Bridge berfungsi memberikan variasi untuk menghindari kebosanan. Dalam membangun struktur lagu, komposer perlu mempertimbangkan keseimbangan antara repetisi dan kejutan, sehingga lagu memiliki karakter khas namun tetap enak didengar. Penyusunan struktur yang baik membantu pendengar memahami emosi dan pesan yang ingin disampaikan dalam lagu. Struktur yang jelas juga menjadi pedoman penting bagi musisi saat mengaransemen atau menampilkan lagu.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Menulis Lirik yang Menyentuh',
                        'articleText' => 'Lirik adalah elemen penting yang mampu memperkuat pesan dan emosi dalam sebuah lagu. Proses menulis lirik melibatkan pemilihan tema, menentukan sudut pandang, serta memilih kata-kata yang puitis namun mudah dipahami. Lirik yang bagus biasanya menyampaikan perasaan dengan cara yang jujur dan relatable bagi pendengar. Teknik seperti metafora, repetisi, dan permainan rima dapat membantu menciptakan lirik yang lebih hidup dan berkesan. Komposer juga perlu memahami bagaimana lirik berpadu dengan melodi, sehingga setiap kata memiliki penempatan ritme yang tepat. Menulis lirik adalah proses yang membutuhkan kepekaan bahasa, kreativitas, dan kemampuan menangkap pengalaman emosional menjadi kalimat yang kuat.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Aransemen Lagu Populer',
                        'vblDesc' => 'Teknik menata ulang lagu agar lebih menarik dan harmonis.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                ],

                'Minggu 4: Performance Project' => [
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Persiapan Konser Mini',
                        'vblDesc' => 'Tips tampil percaya diri di atas panggung.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Gestur Panggung Profesional',
                        'vblDesc' => 'Pelajari ekspresi tubuh dan interaksi dengan audiens.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Latihan Band Ensemble',
                        'vblDesc' => 'Simulasi latihan bersama pemain band untuk penampilan live.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Video Evaluasi Penampilan',
                        'vblDesc' => 'Analisis performa untuk peningkatan di penampilan berikutnya.',
                        'vblUrl' => 'https://youtu.be/fkIgvXC2vVQ?si=aja_pzsfwZjEI6Yf',
                        'duration' => 10
                    ],
                ],
            ],

            // 📷 SENI FOTOGRAFI
            'Seni Fotografi' => [
                'Minggu 1: Dasar Kamera dan Pencahayaan' => [
                    [
                        'articleName' => 'Mengenal Segitiga Exposure',
                        'articleText' => 'Segitiga exposure adalah fondasi utama dalam fotografi yang menentukan seberapa terang atau gelap sebuah foto. Konsep ini mencakup tiga elemen penting: ISO, aperture, dan shutter speed. ISO mengatur sensitivitas sensor terhadap cahaya, aperture mengontrol seberapa besar cahaya masuk melalui lensa sekaligus menentukan kedalaman ruang, sedangkan shutter speed mengatur seberapa lama sensor menerima cahaya. Dengan memahami hubungan ketiganya, fotografer dapat menyesuaikan pencahayaan sesuai kondisi, menghindari foto terlalu gelap (underexposed) atau terlalu terang (overexposed), sekaligus menciptakan efek visual yang diinginkan dalam setiap pemotretan.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Pencahayaan Dasar untuk Fotografer Pemula',
                        'vblDesc' => 'Belajar lighting alami dan buatan untuk berbagai kondisi pemotretan.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Membaca Histogram Foto',
                        'articleText' => 'Histogram adalah alat visual yang membantu fotografer membaca distribusi cahaya dalam sebuah foto. Grafik ini menunjukkan penyebaran nada dari hitam (bayangan) hingga putih (highlight). Dengan memahami histogram, fotografer dapat mengetahui apakah foto memiliki pencahayaan yang seimbang atau tidak. Misalnya, histogram yang menumpuk di sisi kiri berarti foto terlalu gelap, sedangkan yang menumpuk di sisi kanan berarti terlalu terang. Memahami grafik ini penting dalam proses pemotretan maupun editing untuk menghasilkan eksposur yang lebih akurat dan detail lebih terjaga.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Lighting Studio Sederhana',
                        'vblDesc' => 'Gunakan lampu rumah untuk hasil foto yang dramatis dan profesional.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                ],

                'Minggu 2: Komposisi Visual' => [
                    [
                        'articleName' => 'Komposisi Visual untuk Pemula',
                        'articleText' => 'Komposisi merupakan seni menata elemen visual dalam sebuah foto agar tampak harmonis dan menarik. Dalam materi ini, fotografer pemula belajar prinsip dasar seperti rule of thirds, leading lines, balance, dan negative space. Teknik-teknik ini membantu menentukan posisi ideal untuk subjek, menciptakan alur pandangan yang nyaman, dan meningkatkan estetika foto. Dengan memahami komposisi, fotografer tidak hanya mengambil gambar, tetapi juga menyusun pesan visual yang lebih kuat dan bermakna.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Mengenal Framing dan Simetri',
                        'articleText' => 'Framing adalah teknik menggunakan elemen-elemen alami seperti jendela, daun, atau bangunan untuk membingkai subjek, sehingga fokus penonton mengarah tepat pada titik penting. Di sisi lain, simetri membantu menciptakan rasa keseimbangan visual yang menenangkan. Dengan memanfaatkan pola simetris, refleksi, atau pengaturan objek yang seimbang, fotografer dapat menghasilkan foto yang memiliki struktur kuat dan estetika yang memikat. Kedua teknik ini membuat foto terlihat lebih profesional tanpa memerlukan peralatan mahal.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Menangkap Perspektif Unik',
                        'articleText' => 'Perspektif menentukan bagaimana sebuah objek terlihat dari sudut pandang tertentu. Dengan mencoba angle yang berbeda seperti low angle, high angle, bird-eye view, atau close-up ekstrem, fotografer dapat menciptakan foto yang tidak biasa dan lebih menarik. Selain itu, pemahaman tentang depth of field juga membantu dalam menciptakan kesan kedalaman, sehingga foto terasa lebih hidup. Materi ini mendorong fotografer untuk bereksperimen dan mengembangkan gaya visual unik.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Panduan Visual Storytelling',
                        'articleText' => 'Fotografi bukan hanya soal mengambil gambar; ini adalah cara bercerita melalui visual. Dalam materi ini, fotografer belajar bagaimana menggunakan pencahayaan, komposisi, warna, dan ekspresi untuk menyampaikan emosi atau narasi tertentu. Setiap foto dapat membawa pesan — mulai dari suasana hangat, sedih, dramatis, hingga ceria — tergantung bagaimana elemen-elemennya dikombinasikan secara sadar. Teknik storytelling visual membuat foto lebih bermakna dan dapat terhubung dengan penontonnya.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],

                'Minggu 3: Fotografi Potret & Lanskap' => [
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Panduan Fotografi Potret',
                        'vblDesc' => 'Pelajari posing dan ekspresi untuk hasil potret yang natural.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Membentuk Mood dalam Potret',
                        'vblDesc' => 'Gunakan pencahayaan dan warna untuk menonjolkan karakter subjek.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Fotografi Lanskap Dramatis',
                        'vblDesc' => 'Mengenal cara mengambil foto lanskap dengan komposisi yang kuat.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                ],

                'Minggu 4: Editing & Portofolio' => [
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Edit Warna dan Kontras',
                        'vblDesc' => 'Panduan menyeimbangkan tone dan pencahayaan untuk hasil maksimal.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'articleName' => null,
                        'articleText' => null,
                        'vblName' => 'Retouching Foto Potret',
                        'vblDesc' => 'Teknik dasar mengedit kulit dan warna tanpa kehilangan naturalitas.',
                        'vblUrl' => 'https://youtu.be/kA1jXBZCHNI?si=qjUrj1b3vQV3Z7El',
                        'duration' => 10
                    ],
                    [
                        'articleName' => 'Strategi Membangun Portofolio Profesional',
                        'articleText' => 'Portofolio adalah langkah penting bagi fotografer untuk menunjukkan kemampuan teknis dan gaya pribadi mereka. Dalam materi ini, peserta mempelajari cara memilih foto terbaik, menyusun urutan foto agar bercerita, dan membangun identitas visual yang konsisten. Selain itu, dibahas bagaimana mengatur portofolio untuk berbagai keperluan seperti melamar pekerjaan, menarik klien, atau mengikuti kompetisi. Dengan perencanaan yang tepat, portofolio dapat menjadi alat kuat untuk membuka peluang profesional di dunia fotografi.',
                        'vblName' => null,
                        'vblDesc' => null,
                        'vblUrl' => null,
                        'duration' => 10
                    ],
                ],
            ],
        ];

        foreach (CourseWeek::all() as $week) {
            $courseType = $week->course->courseType;
            $weekName = $week->weekName;

            if (isset($materis[$courseType][$weekName])) {
                foreach ($materis[$courseType][$weekName] as $item) {
                    CourseMateri::create([
                        'weekId' => $week->id,
                        'articleName' => $item['articleName'],
                        'articleText' => $item['articleText'],
                        'vblName' => $item['vblName'],
                        'vblDesc' => $item['vblDesc'],
                        'vblUrl' => $item['vblUrl'],
                        'duration' =>$item['duration']
                    ]);
                }
            }
        };

    }
}
