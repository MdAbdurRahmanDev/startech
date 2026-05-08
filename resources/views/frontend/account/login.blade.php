@extends('layouts.app')

@section('title', 'Account Login | Star Tech')

@section('styles')
<style>
    .auth-container {
        max-width: 450px;
        margin: 60px auto;
        background-color: var(--white);
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .auth-header h1 {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .form-group label span {
        float: right;
        font-weight: normal;
        color: var(--accent-orange);
        cursor: pointer;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        outline: none;
        font-size: 14px;
    }

    .form-group input:focus {
        border-color: var(--accent-blue);
    }

    .auth-btn {
        width: 100%;
        background-color: var(--accent-blue);
        color: var(--white);
        padding: 12px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
        font-size: 15px;
        margin-top: 10px;
    }

    .auth-footer {
        text-align: center;
        margin-top: 30px;
        font-size: 13px;
        color: #666;
    }

    .create-account-btn {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        border: 1px solid var(--accent-blue);
        color: var(--accent-blue);
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        margin-top: 15px;
        font-size: 14px;
    }

    .create-account-btn:hover {
        background-color: #f0f4f9;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb" style="padding: 15px 0; font-size: 13px;">
        <a href="#"><i class="fas fa-home"></i></a> / Account / Login
    </div>

    <div class="auth-container">
        <div class="auth-header">
            <h1>Account Login</h1>
        </div>
        
        <form action="#">
            <div class="form-group">
                <label>Phone / E-Mail</label>
                <input type="text" placeholder="Phone / E-Mail">
            </div>

            <div class="form-group">
                <label>Password <span>Forgotten Password?</span></label>
                <input type="password" placeholder="Password">
            </div>

            <button type="submit" class="auth-btn">Login</button>
        </form>

        <div class="auth-footer">
            <p>Don't have an account?</p>
            <a href="{{ url('/account/register') }}" class="create-account-btn">Create Your Account</a>
        </div>
    </div>
</div>
@endsection
