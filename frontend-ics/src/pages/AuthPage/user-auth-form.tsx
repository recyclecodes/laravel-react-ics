import * as React from 'react';

import { cn } from '@/lib/utils';
import { Icons } from '@/components/icons';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { useCallback, useState } from 'react';


interface UserAuthFormProps extends React.HTMLAttributes<HTMLDivElement> {}

export const UserAuthForm = ({ className, ...props }: UserAuthFormProps) => {
  const [isLoading, setIsLoading] = React.useState<boolean>(false);
  const [variant, setVariant] = useState('login');

  const toggleVariant = useCallback(() => {
    setVariant((currenVariant) =>
      currenVariant == 'login' ? 'register' : 'login'
    );
  }, []);

  async function onSubmit(event: React.SyntheticEvent) {
    event.preventDefault();
    setIsLoading(true);

    setTimeout(() => {
      setIsLoading(false);
    }, 3000);
  }

  return (
    <>
      <div className="flex flex-col space-y-2 text-center">
        <h1 className="text-2xl font-semibold tracking-tight">
          {variant === 'login' ? 'Login to your account' : 'Create an account'}
        </h1>
        <p className="text-sm text-muted-foreground">
          {variant === 'login'
            ? `Don't have and account yet? `
            : `Already have an account? `}
          <span
            onClick={toggleVariant}
            className="text-primary hover:underline cursor-pointer"
          >
            {variant === 'login' ? `Sign up` : `Login`}
          </span>
        </p>
      </div>
      <div className={cn('grid gap-6', className)} {...props}>
        <form onSubmit={onSubmit}>
          <div className="grid gap-2">
            {variant == 'register' && (
              <div className="grid gap-1">
                <Label className="sr-only" htmlFor="name">
                  Name
                </Label>
                <Input
                  id="name"
                  placeholder="Juan Dela Cruz"
                  type="text"
                  autoCapitalize="none"
                  autoComplete="name"
                  autoCorrect="off"
                  disabled={isLoading}
                />
              </div>
              
            )}
            <div className="grid gap-1">
                <Label className="sr-only" htmlFor="email">
                  Email
                </Label>
                <Input
                  id="email"
                  placeholder="email@example.com"
                  type="email"
                  autoCapitalize="none"
                  autoComplete="email"
                  autoCorrect="off"
                  disabled={isLoading}
                />
              </div>
            <div className="grid gap-1">
              <Label className="sr-only" htmlFor="email">
                Password
              </Label>
              <Input
                id="password"
                placeholder="••••••••"
                type="password"
                autoCapitalize="none"
                autoComplete="email"
                autoCorrect="off"
                disabled={isLoading}
              />
            </div>
            {variant == 'register' && (
              <div className="grid gap-1">
                <Label className="sr-only" htmlFor="name">
                  Confirm Password
                </Label>
                <Input
                  id="password"
                  placeholder="••••••••"
                  type="password"
                  autoCapitalize="none"
                  autoComplete="name"
                  autoCorrect="off"
                  disabled={isLoading}
                />
              </div>
              
            )}
            <Button disabled={isLoading}>
              {isLoading && (
                <Icons.spinner className="mr-2 h-4 w-4 animate-spin" />
              )}
              {variant === 'login' ? 'Login' : 'Register'}
            </Button>
          </div>
        </form>
      </div>
    </>
  );
};
