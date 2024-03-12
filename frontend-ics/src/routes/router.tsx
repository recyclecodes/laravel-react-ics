    import { createBrowserRouter } from 'react-router-dom';
    import { privateRoutes, publicRoutes } from '.';

    export const router = createBrowserRouter([...publicRoutes, ...privateRoutes]);

    