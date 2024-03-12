import { useContext } from "react";
import { AuthContext } from "../AuthProvider";

export const useAuth = () => {
 
  const context = useContext(AuthContext);
  console.log("Auth context:", context);

  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }

  return context;
};