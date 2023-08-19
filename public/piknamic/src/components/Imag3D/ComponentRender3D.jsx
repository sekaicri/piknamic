import React, {Suspense, useRef} from 'react'
import {Canvas} from 'react-three-fiber'
import { Model } from './Empaque_prueba'
import {OrbitControls} from '@react-three/drei'

export default function ComponenteRender3D() {

  const canvasRef = useRef(null);

  const handleWheel = (e) => {
    e.preventDefault();
  };

  return (
    <div
        style={{ width: '100%', height: '100%' }}
        onWheel={handleWheel}
        ref={(el) => {if (el) {el.addEventListener('wheel', handleWheel, { passive: false });}
        }}

    >
        <Canvas camera={{ zoom: 4, position: [15, 20, 15] }} style={{ display: 'block' }} ref={canvasRef} >
            <ambientLight intensity={0.5} />
            <pointLight position={[35, 35, 15]} intensity={0.8} />
            <pointLight position={[-35, 35, 15]} intensity={0.8} />
            <pointLight position={[0, 0, -35]} intensity={0.8} />
            <pointLight position={[0, -35, 0]} intensity={0.8} />
            <Suspense fallback={null}>
                <Model />
            </Suspense>
            <OrbitControls enableZoom={false}/>
        </Canvas>
    </div>
);
}
