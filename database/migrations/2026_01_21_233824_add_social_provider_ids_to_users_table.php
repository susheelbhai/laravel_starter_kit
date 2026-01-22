<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique();
            $table->string('facebook_id')->nullable()->unique();
            $table->string('x_id')->nullable()->unique();
            $table->string('linkedin_id')->nullable()->unique();
            $table->string('github_id')->nullable()->unique()->after('linkedin_id');
            $table->string('gitlab_id')->nullable()->unique()->after('github_id');
            $table->string('bitbucket_id')->nullable()->unique()->after('gitlab_id');
            $table->string('slack_id')->nullable()->unique()->after('bitbucket_id');
            $table->string('apple_id')->nullable()->unique()->after('slack_id');
            $table->string('amazon_id')->nullable()->unique()->after('apple_id');
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique();
            $table->string('facebook_id')->nullable()->unique();
            $table->string('x_id')->nullable()->unique();
            $table->string('linkedin_id')->nullable()->unique();
            $table->string('github_id')->nullable()->unique()->after('linkedin_id');
            $table->string('gitlab_id')->nullable()->unique()->after('github_id');
            $table->string('bitbucket_id')->nullable()->unique()->after('gitlab_id');
            $table->string('slack_id')->nullable()->unique()->after('bitbucket_id');
            $table->string('apple_id')->nullable()->unique()->after('slack_id');
            $table->string('amazon_id')->nullable()->unique()->after('apple_id');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique();
            $table->string('facebook_id')->nullable()->unique();
            $table->string('x_id')->nullable()->unique();
            $table->string('linkedin_id')->nullable()->unique();
            $table->string('github_id')->nullable()->unique()->after('linkedin_id');
            $table->string('gitlab_id')->nullable()->unique()->after('github_id');
            $table->string('bitbucket_id')->nullable()->unique()->after('gitlab_id');
            $table->string('slack_id')->nullable()->unique()->after('bitbucket_id');
            $table->string('apple_id')->nullable()->unique()->after('slack_id');
            $table->string('amazon_id')->nullable()->unique()->after('apple_id');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique();
            $table->string('facebook_id')->nullable()->unique();
            $table->string('x_id')->nullable()->unique();
            $table->string('linkedin_id')->nullable()->unique();
            $table->string('github_id')->nullable()->unique()->after('linkedin_id');
            $table->string('gitlab_id')->nullable()->unique()->after('github_id');
            $table->string('bitbucket_id')->nullable()->unique()->after('gitlab_id');
            $table->string('slack_id')->nullable()->unique()->after('bitbucket_id');
            $table->string('apple_id')->nullable()->unique()->after('slack_id');
            $table->string('amazon_id')->nullable()->unique()->after('apple_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'facebook_id', 'x_id', 'linkedin_id', 'github_id', 'gitlab_id', 'bitbucket_id', 'slack_id', 'apple_id', 'amazon_id']);
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'facebook_id', 'x_id', 'linkedin_id', 'github_id', 'gitlab_id', 'bitbucket_id', 'slack_id', 'apple_id', 'amazon_id']);
        });
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'facebook_id', 'x_id', 'linkedin_id', 'github_id', 'gitlab_id', 'bitbucket_id', 'slack_id', 'apple_id', 'amazon_id']);
        });
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'facebook_id', 'x_id', 'linkedin_id', 'github_id', 'gitlab_id', 'bitbucket_id', 'slack_id', 'apple_id', 'amazon_id']);
        });
    }
};
