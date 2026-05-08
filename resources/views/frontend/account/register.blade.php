@extends('layouts.app')

@section('title', 'Register Account | Star Tech')

@section('styles')
<style>
    .auth-container {
        max-width: 600px;
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
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
        color: var(--accent-orange);
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

    .policy-check {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        margin: 20px 0;
    }

    .policy-check input {
        width: 16px;
        height: 16px;
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
    }

    .auth-footer {
        text-align: center;
        margin-top: 30px;
        font-size: 13px;
        color: #666;
    }

    .auth-footer a {
        color: var(--accent-orange);
        text-decoration: none;
    }

    @media (max-width: 600px) {
        .form-row { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb" style="padding: 15px 0; font-size: 13px;">
        <a href="#"><i class="fas fa-home"></i></a> / Account / Register
    </div>

    <div class="auth-container">
        <div class="auth-header">
            <h1>Register Account</h1>
        </div>
        
        <form action="#">
            <div class="form-row">
                <div class="form-group">
                    <label>First Name <span>*</span></label>
                    <input type="text" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label>Last Name <span>*</span></label>
                    <input type="text" placeholder="Last Name">
                </div>
            </div>

            <div class="form-group">
                <label>E-Mail <span>*</span></label>
                <input type="email" placeholder="E-Mail">
            </div>

            <div class="form-group">
                <label>Telephone <span>*</span></label>
                <input type="text" placeholder="Telephone">
            </div>

            <div class="policy-check">
                <input type="checkbox">
                <span>I have read and agree to the <a href="#" style="color: var(--accent-orange); text-decoration: none;">Privacy Policy</a></span>
            </div>

            <button type="submit" class="auth-btn">Continue</button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="{{ url('/account/login') }}">login page</a></p>
        </div>
    </div>
</div>
@endsection
