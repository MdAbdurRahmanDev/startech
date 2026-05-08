@extends('layouts.app')

@section('title', $title . ' | Star Tech')

@section('styles')
<style>
    .info-page-container {
        background-color: var(--white);
        padding: 40px;
        margin-top: 25px;
        margin-bottom: 60px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        color: #333;
    }

    .info-page-container h1 {
        font-size: 22px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 40px;
        color: #081621;
    }

    .info-page-container h2 {
        font-size: 18px;
        font-weight: bold;
        margin: 30px 0 15px;
    }

    .info-page-container p {
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 15px;
    }

    .info-page-container a {
        color: var(--accent-orange);
        text-decoration: none;
    }

    .info-page-container a:hover {
        text-decoration: underline;
    }

    .info-page-container ul {
        margin: 15px 0 20px 20px;
        font-size: 14px;
    }

    .info-page-container ul li {
        margin-bottom: 10px;
        line-height: 1.6;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb" style="padding: 15px 0; font-size: 13px;">
        <a href="#"><i class="fas fa-home"></i></a> / Information / {{ $title }}
    </div>

    <div class="info-page-container">
        <h1>{{ $title }}</h1>
        
        @if($title == 'Star Tech Ltd. - Affiliate Marketing Program')
            <p><a href="#">Star Tech Ltd.</a>, the leading E-commerce platform in Bangladesh, now lets users earn commission on sales from its website. If you're a content producer, tech nerd, freelancer, or influencer in Bangladesh, you can earn a hefty commission from referring products already available on <a href="#">startech.com.bd</a>. With an amplitude of tech products, gadgets, and lifestyle items to promote, unlock a limitless earning potential from the most prominent tech retailer in the nation. <a href="#">Join the affiliate program at Star Tech</a> to get started now!</p>

            <h2>What Is Star Tech Affiliate Marketing?</h2>
            <p><a href="#">Star Tech Affiliate Program</a> is an affiliate marketing initiative designed to promote and boost sales of products on <a href="#">startech.com.bd</a>. Through this program, individuals can collaborate with Star Tech and earn commission by referring customers. The program is a simple and effective way for individuals and businesses to monetize their online presence while helping Star Tech expand its customer base.</p>

            <h2>How does it work?</h2>
            <p>Star Tech affiliate marketing in Bangladesh works by rewarding affiliates with a lucrative commission for each sale from the Star Tech E-Commerce platform. Interested parties can earn by registering with Star Tech and referring affiliate links to the customer. <strong>As an affiliate of startech.com.bd, you will receive a unique tracking link or code to share with your audience</strong> through various channels such as websites, blogs, social media, or email marketing.</p>

            <h2>How To Earn Through Star Tech Affiliate Program?</h2>
            <p>By completing four (04) simple steps, anyone can become a Star Tech Affiliate and earn through the affiliate program. The steps are as follows:</p>
            <ul>
                <li>Registering as a Star Tech Affiliate,</li>
                <li>Generating affiliate tracking links</li>
                <li>Promoting your affiliate link,</li>
                <li>Withdrawing payout.</li>
            </ul>

            <h2>How to Register?</h2>
            <p>To register as a Star Tech affiliate, follow the link below and fill in the necessary information along with your designated payout method and account password.</p>
            <p>Star Tech Affiliate registration link -</p>
            <p><a href="#">https://www.startech.com.bd/affiliate/register</a></p>
        @else
            <p>This is a placeholder for the {{ $title }} content. In a real application, this content would be fetched from a database or a specialized language file to ensure accuracy and easy updates.</p>
            <h2>Terms and Conditions</h2>
            <p>Standard terms and conditions apply to this policy. For more detailed information, please contact our support team at 16793.</p>
        @endif
    </div>
</div>
@endsection
