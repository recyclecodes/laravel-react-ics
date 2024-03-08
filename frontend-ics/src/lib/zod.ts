import { z } from 'zod';

export const registerSchema = z
  .object({
    name: z
      .string()
      .min(2, 'Fullname if required')
      .regex(/^[a-zA-Z\s]+$/, 'Fullname must not contain symbol'),
    email: z
      .string()
      .min(1, { message: 'Email is required' })
      .email({ message: 'Invalid email format' }),
    password: z
      .string()
      .min(8, 'The password field must be at least 8 characters')
      .regex(
        /[!@#$%^&*(),.?":{}|<>]/,
        'The password field must contain at least one symbol.'
      )
      .regex(/[0-9]/, 'The password field must contain at least one number')
      .regex(
        /[A-Za-z]/,
        'The password field must contain at least one uppercase and one lowercase letter.'
      ),
    password_confirmation: z.string(),
  })
  .refine((data) => data.password === data.password_confirmation, {
    message: 'The confirm password field must match password.',
    path: ['password_confirmation'],
  });
export type RegisterFields = z.infer<typeof registerSchema>;

export const loginSchema = z.object({
  email: z
    .string()
    .min(1, { message: "Email can't be empty" })
    .email({ message: 'Invalid email format' }),
  password: z.string().min(1, "Password can't be empty"),
});
export type LoginFields = z.infer<typeof loginSchema>;
