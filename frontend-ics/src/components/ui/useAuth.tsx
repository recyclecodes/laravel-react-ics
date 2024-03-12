import { useContext } from "react";
import { AuthContext } from "../AuthProvider";

export const useAuth = () => {
  const user = useContext(AuthContext);

  if (user === null) {
    throw new Error('useAuth must be used within an AuthProvider');
  }

  // Check if user is signed in based on whether user object is present
  const isSignedIn = user !== null;

  return { user, isSignedIn };
};
