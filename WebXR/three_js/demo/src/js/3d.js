
import { GLTFLoader } from './node_modules/three/examples/jsm/loaders/GLTFLoader.js';


loader.load( 'path/to/model.glb', function ( gltf ) {

	scene.add( gltf.scene );

}, undefined, function ( error ) {

	console.error( error );

} );