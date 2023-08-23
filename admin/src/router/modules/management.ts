const management: AuthRoute.Route = {
  name: 'management',
  path: '/management',
  component: 'basic',
  children: [
    // {
    //   name: 'management_auth',
    //   path: '/management/auth',
    //   component: 'self',
    //   meta: {
    //     title: '权限管理',
    //     i18nTitle: 'routes.management.auth',
    //     requiresAuth: true,
    //     icon: 'ic:baseline-security'
    //   }
    // },
    // {
    //   name: 'management_role',
    //   path: '/management/role',
    //   component: 'self',
    //   meta: {
    //     title: '角色管理',
    //     i18nTitle: 'routes.management.role',
    //     requiresAuth: true,
    //     icon: 'carbon:user-role'
    //   }
    // },
    {
      name: 'management_admin_member',
      path: '/management/admin/member',
      component: 'self',
      meta: {
        title: '后台用户管理',
        requiresAuth: true,
        icon: 'ic:round-manage-accounts'
      }
    }
    // {
    //   name: 'management_route',
    //   path: '/management/route',
    //   component: 'self',
    //   meta: {
    //     title: '路由管理',
    //     i18nTitle: 'routes.management.route',
    //     requiresAuth: true,
    //     icon: 'material-symbols:route'
    //   }
    // }
  ],
  meta: {
    title: '系统管理',
    i18nTitle: 'routes.management._value',
    icon: 'carbon:cloud-service-management',
    order: 114514
  }
};

export default management;