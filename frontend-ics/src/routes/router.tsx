    import { createBrowserRouter } from 'react-router-dom';
    import { privateRoutes, publicRoutes } from '.';
    // import { userCheck } from '@/hooks';

    // let ProtectedRoutes: RouteOb = [];
    // if (userCheck) {
    // ProtectedRoutes = privateRoutes;
    // }

    export const router = createBrowserRouter([...publicRoutes, ...privateRoutes]);

    