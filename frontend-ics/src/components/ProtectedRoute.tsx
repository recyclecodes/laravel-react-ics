import { useEffect } from 'react';
import { Navigate, useNavigate } from 'react-router-dom';
import { useAuth } from './ui/useAuth';



interface ProtectedRouteProps {
  children: React.ReactNode;
}

export default function ProtectedRoute({ children }: ProtectedRouteProps) {
  const user = useAuth();
  const navigate = useNavigate();

  useEffect(() => {

    console.log(user)
    if (!user) {
    
      navigate('/login', { replace: true });
    }
  }, [navigate, user]);

  return user ? <>{children}</> : <Navigate to="/login" replace />;
}

