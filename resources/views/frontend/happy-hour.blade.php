@extends('layouts.app')

@section('title', 'Happy Hour | Star Tech')

@section('styles')
<style>
    .happy-hour-container {
        background-color: var(--white);
        border-radius: 8px;
        padding: 60px 20px;
        margin-top: 40px;
        margin-bottom: 60px;
        text-align: center;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }

    .happy-hour-container h1 {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    .happy-hour-container p {
        font-size: 15px;
        color: #444;
        max-width: 800px;
        margin: 0 auto 40px;
        line-height: 1.6;
    }

    .countdown-title {
        font-size: 13px;
        font-weight: bold;
        color: var(--accent-orange);
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .countdown-timer {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .timer-box {
        background-color: var(--accent-orange);
        color: var(--white);
        width: 70px;
        height: 70px;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .timer-box .value {
        font-size: 24px;
        font-weight: bold;
    }

    .timer-box .label {
        font-size: 10px;
        text-transform: uppercase;
        opacity: 0.9;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb" style="padding: 15px 0; font-size: 13px;">
        <a href="#"><i class="fas fa-home"></i></a> / Happy Hour
    </div>

    <div class="happy-hour-container">
        <h1>শুরু হচ্ছে স্টার টেক Happy Hour!</h1>
        <p>আজ রাত ১০টায়, আপনার পছন্দের Laptop, Desktop, Monitor, Smart Watch, Keyboard, Mouse, Headphone-সহ প্রযুক্তি পণ্য পাচ্ছেন নিশ্চিত মূল্যছাড়।</p>

        <div class="countdown-title">Starting In</div>
        
        <div class="countdown-timer">
            <div class="timer-box">
                <span class="value">00</span>
                <span class="label">Days</span>
            </div>
            <div class="timer-box">
                <span class="value">09</span>
                <span class="label">Hours</span>
            </div>
            <div class="timer-box">
                <span class="value">51</span>
                <span class="label">Minutes</span>
            </div>
            <div class="timer-box">
                <span class="value">11</span>
                <span class="label">Seconds</span>
            </div>
        </div>
    </div>
</div>
@endsection
