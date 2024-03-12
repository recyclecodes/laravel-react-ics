import * as React from 'react';

import { cn } from '@/lib/utils';
import { Icons } from '@/components/icons';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { SubmitHandler, useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { LoginFields, loginSchema } from '@/lib/zod';
import { useState } from 'react';
import Axios from '@/lib/axios';
import { Link, useNavigate } from 'react-router-dom';

interface UserAuthFormProps extends React.HTMLAttributes<HTMLDivElement> {}

export const LoginAuthForm = ({ className, ...props }: UserAuthFormProps) => {
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
  } = useForm<LoginFields>({
    resolver: zodResolver(loginSchema),
  });

  const navigate = useNavigate();
  const [passwordShown, setPasswordShown] = useState(false);
  const togglePassVisiblity = () => {
    setPasswordShown(passwordShown ? false : true);
  };

  const onSubmit: SubmitHandler<LoginFields> = async (data) => {
    try {
      await new Promise((resolve) => setTimeout(resolve, 1000));
      const user = await Axios.post('/login', data);
      window.localStorage.setItem('token', user.data.data.token);
      window.localStorage.setItem('user', JSON.stringify(user.data.data.name));
      navigate('/dashboard');
      // console.log('user >>>>>>', JSON.stringify(user.data.data.name));
      // console.log(data);
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <>
      <div className="flex flex-col space-y-2 text-center">
        <h1 className="text-2xl font-semibold tracking-tight">
          Login to your account
        </h1>
        <p className="text-sm text-muted-foreground">
          Don't have an account?{' '}
          <Link to="/register">
            <span className="text-primary hover:underline cursor-pointer">
              Sign-up
            </span>{' '}
          </Link>
        </p>
      </div>
      <div className={cn('grid gap-6', className)} {...props}>
        <form onSubmit={handleSubmit(onSubmit)}>
          <div className="grid gap-2">
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
            <Button disabled={isSubmitting} type="submit">
              {isSubmitting ? (
                <>
                  <Icons.spinner className="mr-2 h-4 w-4 animate-spin" />{' '}
                  Logging in
                </>
              ) : (
                'Login'
              )}
            </Button>
            {/* {errors.root && (
              <span className="text-destructive text-xs">
                {errors.root?.message}
              </span>
            )} */}
          </div>
        </form>
      </div>
    </>
  );
};
