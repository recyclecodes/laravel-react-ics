// import { User } from '@/types/User';
import { createContext, useEffect, useState } from 'react';

export const AuthContext = createContext<AuthContextProps | null>(null);

interface  AuthContextProps {
    isSignedIn?: boolean;
}

interface AuthProviderProps {
  children: React.ReactNode;
  
}

export default function AuthProvider({ children }: AuthProviderProps) {
  const [isSignedIn, setIsSignedIn] = useState<AuthContextProps["isSignedIn"]>(false)

  useEffect(() => {
    const token = window.localStorage.getItem('token');
    const storedUser = window.localStorage.getItem('user');

   
      setIsSignedIn(!!(!isSignedIn && token && storedUser));
  }, []);

  return <AuthContext.Provider value={{isSignedIn}}>{children}</AuthContext.Provider>;
}

