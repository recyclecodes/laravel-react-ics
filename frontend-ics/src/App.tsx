import { RouterProvider } from 'react-router-dom';
// import AuthProvider from './components/AuthProvider';
import { ThemeProvider } from './components/theme-provider';
import { router } from './routes/router';

function App() {
  return (
    <ThemeProvider defaultTheme="dark" storageKey="vite-ui-theme">
      {/* <AuthProvider isSignedIn={false}> */}
        <RouterProvider router={router} />
      {/* </AuthProvider> */}
    </ThemeProvider>
  );
}

export default App;
