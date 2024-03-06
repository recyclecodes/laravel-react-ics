import * as React from 'react';

import { cn } from '@/lib/utils';
import { Icons } from '@/components/icons';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { SubmitHandler, useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { RegisterFields, registerSchema } from '@/lib/zod';
import { useState } from 'react';

interface UserAuthFormProps extends React.HTMLAttributes<HTMLDivElement> {}

export const RegisterAuthForm = ({
  className,
  ...props
}: UserAuthFormProps) => {
  const {
    register,
    handleSubmit,
    setError,
    formState: { errors, isSubmitting },
  } = useForm<RegisterFields>({
    resolver: zodResolver(registerSchema),
  });

  // const [isSubmitting, setisSubmitting] = React.useState<boolean>(false);
  // const [variant, setVariant] = useState('login');

  // const toggleVariant = useCallback(() => {
  //   setVariant((currenVariant) =>
  //     currenVariant == 'login' ? 'register' : 'login'
  //   );
  // }, []);

  // async function onSubmit(event: React.SyntheticEvent) {
  //   event.preventDefault();
  //   setisSubmitting(true);

  //   setTimeout(() => {
  //     setisSubmitting(false);
  //   }, 3000);
  // }
  const [passwordShown, setPasswordShown] = useState(false);
  const togglePassVisiblity = () => {
    setPasswordShown(passwordShown ? false : true);
  };

  const onSubmit: SubmitHandler<RegisterFields> = async (data) => {
    try {
      await new Promise((resolve) => setTimeout(resolve, 1000));
      console.log(data);
    } catch (error) {
      setError('root', {
        message: 'This email is already taken',
      });
    }
  };

  return (
    <>
      <div className="flex flex-col space-y-2 text-center">
        <h1 className="text-2xl font-semibold tracking-tight">
          Create an account
        </h1>
        <p className="text-sm text-muted-foreground">
          Already have an account?{' '}
          <span className="text-primary hover:underline cursor-pointer">
            Sign-in
          </span>
        </p>
      </div>
      <div className={cn('grid gap-6', className)} {...props}>
        <form onSubmit={handleSubmit(onSubmit)}>
          <div className="grid gap-3">
            <div className="grid gap-1">
              <Label className="not-sr-only" htmlFor="name">
                Name
              </Label>
              <Input
                {...register('name')}
                id="name"
                placeholder="Juan Dela Cruz"
                type="text"
                autoCapitalize="none"
                autoComplete="name"
                autoCorrect="off"
                disabled={isSubmitting}
              />
              {errors.name && (
                <span className="text-destructive text-xs">
                  {errors.name?.message}
                </span>
              )}
            </div>
            <div className="grid gap-1">
              <Label className="not-sr-only" htmlFor="email">
                Email
              </Label>
              <Input
                {...register('email')}
                id="email"
                placeholder="email@example.com"
                type="email"
                autoCapitalize="none"
                autoComplete="email"
                autoCorrect="off"
                disabled={isSubmitting}
              />
              {errors.email && (
                <span className="text-destructive text-xs">
                  {errors.email?.message}
                </span>
              )}
            </div>
            <div className="grid gap-1">
              <Label className="not-sr-only" htmlFor="email">
                Password
              </Label>
              <div className="flex relative gap-1">
                <Input
                  {...register('password')}
                  id="password"
                  placeholder="••••••••"
                  type={passwordShown ? 'text' : 'password'}
                  autoCapitalize="none"
                  autoComplete="email"
                  autoCorrect="off"
                  disabled={isSubmitting}
                />
                {passwordShown ? (
                  <Icons.eye
                    onClick={togglePassVisiblity}
                    className="absolute top-[28%] right-0 mr-2 h-5 w-5 cursor-pointer hover:text-gray-900 text-gray-500"
                  />
                ) : (
                  <Icons.eyeSlash
                    onClick={togglePassVisiblity}
                    className="absolute top-[28%] right-0 mr-2 h-5 w-5 cursor-pointer hover:text-gray-900 text-gray-500"
                  />
                )}
              </div>

              {errors.password && (
                <span className="text-destructive text-xs">
                  {errors.password?.message}
                </span>
              )}
            </div>
            <div className="grid gap-1">
              <Label className="not-sr-only" htmlFor="name">
                Confirm Password
              </Label>
              <Input
                {...register('confirm_password')}
                id="confirm_password"
                placeholder="••••••••"
                type="password"
                autoCapitalize="none"
                autoComplete="name"
                autoCorrect="off"
                disabled={isSubmitting}
              />
              {errors.confirm_password && (
                <span className="text-destructive text-xs">
                  {errors.confirm_password?.message}
                </span>
              )}
            </div>
            <Button disabled={isSubmitting} type="submit">
              {isSubmitting ? (
                <>
                  <Icons.spinner className="mr-2 h-4 w-4 animate-spin" />{' '}
                  Registering
                </>
              ) : (
                'Register'
              )}
            </Button>
            {errors.root && (
              <span className="text-destructive text-xs">
                {errors.root?.message}
              </span>
            )}
          </div>
        </form>
      </div>
    </>
  );
};
