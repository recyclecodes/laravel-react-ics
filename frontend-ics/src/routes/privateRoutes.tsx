// import ProtectedRoute from '@/components/ProtectedRoute';
import Dashboard from '@/pages/Dashboard';

export const privateRoutes = [
  {
    path: 'dashboard',
    element: <Dashboard/>
  },
];

// element: (
//   <ProtectedRoute>
//     <Dashboard />,
//   </ProtectedRoute>
// ),