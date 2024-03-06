import { ModeToggle } from '@/components/mode-toggle';
import { ThemeProvider } from '@/components/theme-provider';
import { LoginAuthForm } from '../Login';
import { RegisterAuthForm } from '../Register';
import { Routes, Route } from 'react-router-dom';


export default function AuthPage() {
  return (
    <>
      <ThemeProvider defaultTheme="dark" storageKey="vite-ui-theme">
        <div className="md:hidden">
          <img src="" alt="" />
          <img src="" alt="" />
        </div>
        <div className="container relative  h-screen flex-col items-center justify-center md:grid lg:max-w-none lg:grid-cols-2 lg:px-0">
          <div className="relative hidden h-full flex-col bg-muted p-10 text-white lg:flex dark:border-r">
            <div className="absolute inset-0 bg-zinc-900" />
            <ModeToggle />
            <div className="relative z-20 flex items-center text-lg font-medium">
              Logo
            </div>
            <div className="relative z-20 mt-auto">
              {/* <blockquote className="space-y-2">
              <p className="text-lg">
                &ldquo;This library has saved me countless hours of work and
                helped me deliver stunning designs to my clients faster than
                ever before.&rdquo;
              </p>
              <footer className="text-sm">Sofia Davis</footer>
            </blockquote> */}
            </div>
          </div>
          <div className="lg:p-8">
            <div className="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[450px]">

                <Routes>
                  <Route path={'/'} element={<LoginAuthForm />} />
                  <Route path={'/login'} element={<LoginAuthForm />} />
                  <Route path={'/register'} element={<RegisterAuthForm />} />
                </Routes>

              {/* <p className="px-8 text-center text-sm text-muted-foreground">
              By clicking continue, you agree to our{" "}
              <Link
                href="/terms"
                className="underline underline-offset-4 hover:text-primary"
              >
                Terms of Service
              </Link>{" "}
              and{" "}
              <Link
                href="/privacy"
                className="underline underline-offset-4 hover:text-primary"
              >
                Privacy Policy
              </Link>
              .
            </p> */}
            </div>
          </div>
        </div>
      </ThemeProvider>
    </>
  );
}
