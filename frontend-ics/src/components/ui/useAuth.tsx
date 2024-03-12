import { useContext } from "react";
import { AuthContext } from "../AuthProvider";
// import { User } from "@/types/User";

// export const useAuth = () => {

  
//     const context = useContext(AuthContext);
  
//     if (context === undefined) {
//       throw new Error('useAuth must be used within an AuthProvider');
//     }
  
//     return [authState, setAuthState, context];
// };

export const useAuth = () => {
  const context = useContext(AuthContext);

  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }

  return context;
};