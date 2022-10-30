

const env = import.meta.env.VITE_APP_ENV;

const location = "http://localhost:8000/api";

if(env === 'production') {
    location = "https://onlyshop.k8s.ing.he-arc.ch/api";
}

export const API_LOCATION=location;

