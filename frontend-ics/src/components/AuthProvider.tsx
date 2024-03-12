import { createContext, PropsWithChildren, useState } from 'react';
import { User } from '../types/User';
import { storedUser, token } from '@/hooks';

export const AuthContext = createContext<User | null>(null);

type AuthProviderProps = PropsWithChildren & {
  isSignedIn?: boolean;
};

export default function AuthProvider({
  children,
  isSignedIn,
}: AuthProviderProps) {
  const [user] = useState<User | null>(
    isSignedIn && token && storedUser ? { id: JSON.parse(storedUser).id } : null
  );

  console.log('User state:', user);

  return <AuthContext.Provider value={user}>{children}</AuthContext.Provider>;
}

// export const useAuth = () => {

//     const context = useContext(AuthContext);
//     console.log("Auth context:", context);

//     if (context === undefined) {
//       throw new Error('useAuth must be used within an AuthProvider');
//     }

//     return context;
//   };
