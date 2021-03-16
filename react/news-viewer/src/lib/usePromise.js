import {useState,useEffect} from 'react';

export default function usePromise(promiseCreator, deps){
    const [loading,setLoading] = useState(false);
    const [resolved,setResolve] = useState(null);
    const [error,setError] = useState(null);

    useEffect(()=>{
        const process = async ()=>{
            setLoading(true);
            try{
                const resolved = await promiseCreator();
                setResolve(resolved);
            }catch(e){
                setError(e);
            }
            setLoading(false);
        };
        process();        
    },deps);
    return [loading,resolved,error];
}