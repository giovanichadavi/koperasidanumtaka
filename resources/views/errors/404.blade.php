<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>404 - Halaman Tidak Ditemukan</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:"Segoe UI",sans-serif}

body{
    height:100vh;
    background:linear-gradient(to bottom,#0f4c75,#3282b8,#bbe1fa);
    overflow:hidden;
}

/* MATAHARI */
.sun{
    position:absolute;
    top:40px;
    right:80px;
    width:120px;
    height:120px;
    background:radial-gradient(circle,#ffe066,#ffb703);
    border-radius:50%;
    box-shadow:0 0 50px rgba(255,200,0,0.7);
    animation:sunPulse 6s ease-in-out infinite;
}
@keyframes sunPulse{
    0%,100%{transform:scale(1)}
    50%{transform:scale(1.05)}
}

/* AWAN */
.cloud{
    position:absolute;
    width:140px;height:70px;
    background:#ffffff;
    border-radius:50px;
    opacity:0.7;
    animation:cloudMove 30s linear infinite;
}
.cloud:before,.cloud:after{
    content:"";position:absolute;background:white;border-radius:50%;
}
.cloud:before{width:60px;height:60px;top:-30px;left:15px}
.cloud:after{width:80px;height:80px;top:-40px;right:15px}

.cloud:nth-child(1){top:6%;left:-200px;animation-duration:25s}
.cloud:nth-child(2){top:12%;left:-300px;animation-duration:35s}
.cloud:nth-child(3){top:18%;left:-400px;animation-duration:40s}
.cloud:nth-child(4){top:10%;left:-500px;animation-duration:30s}
.cloud:nth-child(5){top:16%;left:-600px;animation-duration:45s}

@keyframes cloudMove{
    from{transform:translateX(0)}
    to{transform:translateX(1600px)}
}

/* KONTEN */
.container{
    position:relative;
    z-index:10;
    height:100vh;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
}

.title-wrap{
    display:flex;
    align-items:center;
    gap:20px;
}

.logo404{
    width:120px;
    height:auto;
}

h1{
    font-size:130px;
    color:#ffffff;
    font-weight:800;
    text-shadow:0 5px 15px rgba(0,0,0,0.4);
}
h2{
    font-size:34px;
    color:#f1f9ff;
    text-shadow:0 2px 6px rgba(0,0,0,0.3);
}
p{
    font-size:18px;
    color:#e3f2fd;
    margin-bottom:25px;
}

a{
    background:#1b6ca8;
    color:white;
    padding:14px 38px;
    border-radius:30px;
    text-decoration:none;
    font-weight:600;
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
    transition:.3s;
}
a:hover{background:#144272;transform:translateY(-2px)}

/* OMBAK */
.wave{
    position:absolute;
    bottom:0;
    width:200%;
    height:220px;
    background:rgba(255,255,255,.35);
    border-radius:100% 100% 0 0;
    animation:waveMove 14s linear infinite;
}
.wave:nth-child(11){bottom:20px;opacity:.5;animation-duration:18s;animation-direction:reverse}
.wave:nth-child(12){bottom:40px;opacity:.7;animation-duration:22s}

@keyframes waveMove{
    from{transform:translateX(0)}
    to{transform:translateX(-50%)}
}

/* GELEMBUNG */
.bubble{
    position:absolute;
    bottom:-50px;
    width:18px;height:18px;
    background:rgba(255,255,255,.7);
    border-radius:50%;
    animation:bubbleUp 4s infinite ease-in;
}
.bubble:nth-child(13){left:10%;animation-duration:5s}
.bubble:nth-child(14){left:25%;animation-duration:7s}
.bubble:nth-child(15){left:40%;animation-duration:6s}
.bubble:nth-child(16){left:60%;animation-duration:9s}
.bubble:nth-child(17){left:80%;animation-duration:8s}

@keyframes bubbleUp{
    from{transform:translateY(0);opacity:1}
    to{transform:translateY(-800px);opacity:0}
}

/* IKAN */
.fish{
    position:absolute;
    left:-150px;
    font-size:34px;
    opacity:0.9;
    animation:fishSwim 12s linear infinite;
}
.fish:nth-child(18){bottom:120px;animation-duration:10s}
.fish:nth-child(19){bottom:180px;animation-duration:14s;font-size:28px}
.fish:nth-child(20){bottom:240px;animation-duration:18s}
.fish:nth-child(21){bottom:300px;animation-duration:22s;font-size:26px}
.fish:nth-child(22){bottom:360px;animation-duration:16s}
.fish:nth-child(23){bottom:420px;animation-duration:20s;font-size:30px}

@keyframes fishSwim{
    from{transform:translateX(0)}
    to{transform:translateX(1600px)}
}
</style>
</head>
<body>

<div class="sun"></div>

<div class="cloud"></div>
<div class="cloud"></div>
<div class="cloud"></div>
<div class="cloud"></div>
<div class="cloud"></div>

<div class="container">
    <div class="title-wrap">
        <!-- GANTI PATH LOGO DI BAWAH -->
        <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" class="logo404" alt="Logo">
        <h1>404</h1>
    </div>

    <h2>Halaman Tidak Ditemukan</h2>
    <p>Maaf, halaman yang Anda cari tidak tersedia atau sudah dipindahkan.</p>
    <a href="{{ url('/') }}">Kembali ke Beranda</a>
</div>

<div class="wave"></div>
<div class="wave"></div>
<div class="wave"></div>

<div class="bubble"></div>
<div class="bubble"></div>
<div class="bubble"></div>
<div class="bubble"></div>
<div class="bubble"></div>

<div class="fish">🐟</div>
<div class="fish">🐠</div>
<div class="fish">🐡</div>
<div class="fish">🐟</div>
<div class="fish">🐠</div>
<div class="fish">🐡</div>

</body>
</html>