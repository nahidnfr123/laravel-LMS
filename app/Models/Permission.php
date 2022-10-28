<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions(): array
    {
        return [
            'access_dashboard',

            'manage_roles_and_permissions',

            'view_attendance',
            'update_attendance',
            'create_attendance',
            'delete_attendance',

            'view_subject',
            'update_subject',
            'create_subject',
            'delete_subject',

            'view_semester',
            'update_semester',
            'create_semester',
            'delete_semester',

            'view_topic',
            'update_topic',
            'create_topic',
            'delete_topic',

            'view_marks',
            'update_marks',
            'create_marks',
            'delete_marks',

            'view_user',
            'update_user',
            'create_user',
            'delete_user',

            'view_course',
            'create_course',
            'update_course',
            'delete_course',

            'view_community_category',
            'update_community_category',
            'create_community_category',
            'delete_community_category',

            'view_community_tag',
            'update_community_tag',
            'create_community_tag',
            'delete_community_tag',

            'view_community_post',
            'update_community_post',
            'create_community_post',
            'delete_community_post',

            'view_order',
            'accept_order',
            'reject_order',
            'delete_order',

            'view_contact',
            'update_contact',
            'create_contact',
            'delete_contact',
        ];
    }
}
