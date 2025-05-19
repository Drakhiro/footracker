<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "map.php") {
    header("Location:../index.php?view=map");
    die("");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php"); // tprint
include_once("libs/maLibForms.php"); // mkTable, mkLiens, mkSelect ...

// Les utilisateurs non connectés ne devraient pas avoir accès à cette vue ! 

// SI (user non connecte) 
// On déclenche une redirection vers la page de connexion avec un message 

if (! valider("connected", "SESSION")) {
    $_REQUEST["msg"] = "Il faut être connecté !";
    include("templates/login.php");
} else {

?>

    <h1>Carte</h1>
    <div id="map-container" style="width: 100%; height: 600px;"></div>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/GLTFLoader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
    <script>
        // Initialiser la scène, la caméra et le rendu
        var scene = new THREE.Scene();
        var container = document.getElementById('map-container');
        var camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
        var renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setClearColor(0x1E1E1E); // Fond gris très foncé/noir
        container.appendChild(renderer.domElement);

        // Ajouter des contrôles pour la navigation
        var controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = false;
        controls.dampingFactor = 0.25;
        controls.screenSpacePanning = false;
        controls.maxPolarAngle = Math.PI / 2;

        // Positionner la caméra
        camera.position.set(0, 5, 1);
        camera.lookAt(0, 0, 0);

        // Ajouter un éclairage
        var ambientLight = new THREE.AmbientLight(0xffffff, 6);
        scene.add(ambientLight);
        
        var directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(1, 1, 1);
        scene.add(directionalLight);

        // Charger la carte 3D
        var loader = new THREE.GLTFLoader();
        loader.load('ressources/map.glb', function(gltf) {
            scene.add(gltf.scene);
            
            // Ajuster la caméra pour voir le modèle entier
            var box = new THREE.Box3().setFromObject(gltf.scene);
            var center = box.getCenter(new THREE.Vector3());
            var size = box.getSize(new THREE.Vector3());
            
            // Ajuster la position de la caméra
            var maxDim = Math.max(size.x, size.y, size.z);
            var fov = camera.fov * (Math.PI / 180);
            var cameraZ = Math.abs(maxDim / 2 / Math.tan(fov / 2));
            
            camera.position.z = center.z + cameraZ * 1.5;
            camera.position.y = center.y + cameraZ * 0.5;
            
            controls.target.set(center.x, center.y, center.z);
            controls.update();

            // Ajouter des blasons
            var blasons = [
                // {
                //     lat: 48.8566,
                //     lng: 2.3522,
                //     texture: 'ressources/blasons/blason1.png'
                // },
                // Ajoutez d'autres blasons ici
            ];

            blasons.forEach(function(blason) {
                var spriteMap = new THREE.TextureLoader().load(blason.texture);
                var spriteMaterial = new THREE.SpriteMaterial({
                    map: spriteMap
                });
                var sprite = new THREE.Sprite(spriteMaterial);
                sprite.scale.set(1, 1, 1); // Taille du blason

                // Convertir les coordonnées géographiques en position 3D
                var position = convertGeoTo3D(blason.lat, blason.lng);
                sprite.position.set(position.x, position.y, position.z);

                scene.add(sprite);
            });
        }, 
        // Callback de progression
        function(xhr) {
            console.log((xhr.loaded / xhr.total * 100) + '% chargé');
        }, 
        // Callback d'erreur
        function(error) {
            console.error('Erreur lors du chargement du modèle:', error);
        });

        // Fonction pour convertir les coordonnées géographiques en position 3D
        function convertGeoTo3D(lat, lng) {
            // Cette fonction doit être adaptée à votre modèle spécifique
            // Voici une implémentation simple supposant une carte plate
            
            // Paramètres à ajuster selon votre modèle et l'échelle de votre carte
            const mapWidth = 10; // Largeur de votre carte 3D
            const mapHeight = 10; // Hauteur de votre carte 3D
            
            // Supposons que les coordonnées géographiques vont de:
            const minLat = 40, maxLat = 60; // Latitude min/max de votre carte
            const minLng = -10, maxLng = 20; // Longitude min/max de votre carte
            
            // Normaliser les coordonnées
            const normalizedX = (lng - minLng) / (maxLng - minLng);
            const normalizedZ = (lat - minLat) / (maxLat - minLat);
            
            // Convertir en coordonnées 3D
            const x = (normalizedX - 0.5) * mapWidth;
            const z = (normalizedZ - 0.5) * mapHeight;
            
            // La hauteur y dépend de votre modèle, ici on la met à 0.5 au-dessus de la surface
            const y = 0.5;
            
            return {
                x: x,
                y: y,
                z: z
            };
        }

        // Gérer le redimensionnement de la fenêtre
        window.addEventListener('resize', function() {
            var container = document.getElementById('map-container');
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        });

        // Animation de rendu
        function animate() {
            requestAnimationFrame(animate);
            controls.update(); // Pour les contrôles avec inertie
            renderer.render(scene, camera);
        }
        animate();
    </script>

<?php
} // FIN si user connecte 
?>
