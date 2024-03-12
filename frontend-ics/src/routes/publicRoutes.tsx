import AuthLayout from '@/layouts/AuthLayout';
import { LoginAuthForm } from '@/pages/Login';
import { RegisterAuthForm } from '@/pages/Register';
import { Navigate } from 'react-router-dom';

export const publicRoutes = [
  {
    path: '*',
    element: <Navigate replace to="/login" />,
  },
  {
    element: <AuthLayout />,
    children: [
      {
        path: '/login',
        element: <LoginAuthForm />,
      },
      {
        path: '/register',
        element: <RegisterAuthForm />,
      },
    ],
  },
];
