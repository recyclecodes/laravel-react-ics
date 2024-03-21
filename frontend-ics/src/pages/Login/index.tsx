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
      localStorage.setItem('token', user.data.data.token);
      localStorage.setItem('user', JSON.stringify(user.data.data.name));
      navigate('/dashboard');
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <>
      {/* <div className="flex flex-col space-y-2 text-center">
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
      </div> */}
      <div className="px-10 absolute w-[100%] -top-[280px]">
        <div className="rounded-2xl shadow-md px-10 py-16 lg:p-8 bg-background ">
          <div className={cn('grid gap-6', className)} {...props}>
            <form onSubmit={handleSubmit(onSubmit)}>
              <div className="grid gap-8">
                <div className="grid gap-2">
                  <Label className="sr-only" htmlFor="email">
                    Email
                  </Label>
                  <div className='flex relative'>
                    <div>
                      <Icons.userAuth className="absolute top-[28%] left-2 h-5 w-5 cursor-pointer hover:text-gray-900 text-primary" />
                    </div>
                    <Input
                      className="rounded-xl h-12 pl-8"
                      {...register('email')}
                      id="email"
                      placeholder="Email"
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
                </div>
                <div className="grid gap-2">
                  <Label className="sr-only" htmlFor="email">
                    Password
                  </Label>

                  <div className="flex relative">
                    <div>
                      <Icons.lockAuth className="absolute top-[28%] left-2 h-5 w-5 cursor-pointer hover:text-gray-900 text-primary" />
                    </div>
                    <Input
                      className="rounded-xl h-12 pl-8"
                      {...register('password')}
                      id="password"
                      placeholder="Password"
                      type={passwordShown ? 'text' : 'password'}
                      autoCapitalize="none"
                      autoComplete="email"
                      autoCorrect="off"
                      disabled={isSubmitting}
                    />

                    {passwordShown ? (
                      <Icons.eye
                        onClick={togglePassVisiblity}
                        className="absolute top-[28%] right-0 mr-2 h-5 w-5 cursor-pointer hover:text-gray-900 text-primary"
                      />
                    ) : (
                      <Icons.eyeSlash
                        onClick={togglePassVisiblity}
                        className="absolute top-[28%] right-0 mr-2 h-5 w-5 cursor-pointer hover:text-gray-900 text-primary"
                      />
                    )}
                  </div>
                  {errors.password && (
                    <span className="text-destructive text-xs">
                      {errors.password?.message}
                    </span>
                  )}
                </div>
                <Button
                  className="rounded-3xl"
                  disabled={isSubmitting}
                  type="submit"
                >
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
            <div className="flex flex-col space-y-2 text-center">
              <p className="text-sm text-muted-foreground">
                Don't have an account?{' '}
                <Link to="/register">
                  <span className="text-primary hover:underline cursor-pointer">
                    Sign-up
                  </span>{' '}
                </Link>
              </p>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};
