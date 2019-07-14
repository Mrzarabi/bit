<?php

return [
    'role_structure' => [
        'owner' => [
            'user' => 'r,u,d,s,a',
            'bank_card'  => 'c,r,u,d,a',
            'ticket'  => 'c,r,d,a',
            'ticket_messages'  => 'c,r,u,d',
            
            'spec' => 'r,c,u,d',
            
            'subject' => 'r,c,u,d',
            'article' => 'r,c,u,d',
            'comment' => 'r,c,a,d',
            
            'category' => 'r,c,u,d',
            'currency' => 'c,r,u,d',
            
            'role' => 'r,c,u,d',

            'setting' => 'c,u'
        ],
    ],

    'permissions_map' => [
        'c'     => 'create',
        'r'     => 'read',
        'u'     => 'update',
        'd'     => 'delete',
        'a'     => 'accept',
        'at'    => 'active',
        's'     => 'see-details',
        'sc'    => 'see-creator',
        // 'ad'    => 'add-item',
        // 'rm'    => 'remove-item',
        // 'sl'    => 'see-log',
        // 'sa'    => 'see-address',
        // 'sph'   => 'see-phone-number',
        // 'si'    => 'see-items',
        // 'chst'  => 'change-status'
        // 'sinv'  => 'see-inventory'
    ],

    'actions_label' => [
        'create'            => 'ثبت',
        'read'              => 'مشاهده',
        'update'            => 'ویرایش',
        'delete'            => 'حذف',
        'accept'            => 'تایید/رد کزدن',
        'active'            => 'فعال/غیرفعال کزدن',
        'see-details'       => 'مشاهده جزییات',
        'see-creator'       => 'مشاهده ثبت کننده',
        // 'add-item'          => 'افزودن به',
        // 'remove-item'       => 'حذف از',
        // 'see-log'           => 'مشاهده لاگ تغییرات',
        // 'see-address'       => 'مشاهده آدرس',
        // 'see-phone-number'  => 'مشاهده شماره تلفن',
        // 'see-items'         => 'مشاهده اقلام',
        // 'change-status'     => 'تغییر وضعیت'
        // 'see-inventory'     => 'مشاهده موجودی',
    ],

    'permissions_label' => [
        'user' => 'کاربر',
        'bank_card' => 'کارت بانکی',
        'ticket'  => 'تیکت ها',
        'ticket_messages'  => 'پیام های تیکت',
        
        'spec' => 'جدول مشخصات فنی',
        
        'subject' => 'دسته بندی مقالات',
        'article' => 'مقالات',
        'comment' => 'نظرات',
        
        'category' => 'دسته بندی محصولات',
        'currency' => 'محصول',
        
        'role' => 'نقش',

        'setting' => 'تنظیمات'
    ],

    'roles_label' => [
        'owner' => [
            'name' => 'مدیر',
            'description' => 'مالک وبسایت بیت کوین'
        ],
        'user' => [
            'name' => 'کاربر',
            'description' => 'کسی که از سایت دیدن میکند'
        ],
    ]
];
