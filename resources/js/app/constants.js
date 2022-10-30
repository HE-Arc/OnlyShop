const env = import.meta.env.VITE_APP_ENV;

let location = "http://localhost:8000/api";

if(env === 'production') {
    location = "https://onlyshop.k8s.ing.he-arc.ch/api";
}

console.log(import.meta.env.VITE_APP_ENV);
console.log(location);
export const API_LOCATION=location;
