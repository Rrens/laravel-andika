<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Input</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body{
    background: #f4f6fb;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.otp-card{
    background: #fff;
    padding: 40px;
    border-radius: 16px;
    width: 400px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

.otp-card h2{
    margin-bottom: 10px;
    color: #222;
}

.otp-card p{
    color: #777;
    font-size: 14px;
    margin-bottom: 30px;
}

.otp-inputs{
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 30px;
}

.otp-inputs input{
    width: 55px;
    height: 60px;
    border: 2px solid #dcdcdc;
    border-radius: 12px;
    text-align: center;
    font-size: 24px;
    font-weight: 600;
    outline: none;
    transition: .3s;
}

.otp-inputs input:focus{
    border-color: #4f46e5;
    box-shadow: 0 0 0 4px rgba(79,70,229,.15);
}

button{
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: #4f46e5;
    color: white;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
}

button:hover{
    background: #4338ca;
}
</style>
<body>

<div class="container">
    <div class="otp-card">
        <h2>Verification Code</h2>
        <p>Enter the 6-digit code sent to your email.</p>
        <form method="post" action="{{ route('verify.otp') }}">
            @csrf
        <div class="otp-inputs">
            <input name="otp[]" type="text" maxlength="1">
            <input name="otp[]" type="text" maxlength="1">
            <input name="otp[]" type="text" maxlength="1">
            <input name="otp[]" type="text" maxlength="1">
            <input name="otp[]" type="text" maxlength="1">
            <input name="otp[]" type="text" maxlength="1">
        </div>

        <input type="email" name="email" placeholder="Email address" style="width:100%;padding:14px;border:2px solid #dcdcdc;border-radius:12px;font-size:16px;outline:none;margin-bottom:20px;transition:.3s;" onfocus="this.style.borderColor='#4f46e5';this.style.boxShadow='0 0 0 4px rgba(79,70,229,.15)'" onblur="this.style.borderColor='#dcdcdc';this.style.boxShadow='none'" required>

        <button type="submit">Verify</button>
        </form>
    </div>
</div>

</body>
</html>
