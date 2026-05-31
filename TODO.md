# Task TODO - Amar Blog Page + Comment System

## Steps
1. ✅ Create DB migration for `blog_comments` table (blog_id, user_id nullable, name, comment, status).
2. ✅ Create `BlogComment` Eloquent model with relations.
3. ✅ Create `Frontend\BlogCommentController@store` to accept guest/login comments and save with `status=0` (pending admin approval).
4. ✅ Update `Frontend\BlogController@show` to fetch approved comments (`status=1`).
5. ✅ Update `resources/views/frontend/pages/blog/show.blade.php`:
   - ✅ Add comment form (guest allowed: name + comment)
   - ✅ Show flash success/error messages
   - ✅ Render approved comments list
6. ✅ Add route: POST `/blog/{slug}/comment`.
7. ✅ (Admin) Create backend controller + blade for approving comments.
8. ✅ Add admin sidebar dropdown link + approve/reject/destroy routes.
9. ⏳ Run `php artisan migrate` and do manual UI testing.


