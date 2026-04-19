<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>attendance</title>
    <link rel="stylesheet" href="{{ asset('css/attendance/index.css') }}">
</head>
<body>

<header class="header">
  <div class="header__inner">
    <div class="header__logo">COACHTECH</div>

     <nav class="header__nav">
       <a href="{{ route('attendance.index') }}">勤怠</a>
       <a href="{{ route('attendance.list') }}">勤怠一覧</a>
       <a href="{{ route('request.list') }}">申請</a>

       <form action="{{ route('logout') }}" method="POST" style="display:inline;">
           @csrf
           <button type="submit">ログアウト</button>
       </form>
     </nav>
  </div>
</header>

<main>
    <main class="attendance">
    <!-- ステータス -->
    <p class="attendance__status @if($status === '勤務外') attendance__status--off @endif">
       {{ $status }}
    </p>

    <!-- 日付と時刻 -->
    <p class="attendance__date">
        {{ $now->format('Y年m月d日') }}（{{ ['日','月','火','水','木','金','土'][$now->dayOfWeek] }}）
    </p>

    <p class="attendance__time">
        {{ $now->format('H:i') }}
    </p>


    <!-- ボタン出し分け -->
    @if ($status === '勤務外')
        <form method="POST" action="{{ route('attendance.clockin') }}">
            @csrf
            <button class="attendance__btn">出勤</button>
        </form>
    @endif

    @if ($status === '出勤中')
      <div class="attendance_btnarea">
        <form method="POST" action="{{ route('attendance.breakin') }}">
            @csrf
            <button class="attendance__btn">休憩入</button>
        </form>

        <form method="POST" action="{{ route('attendance.clockout') }}">
            @csrf
            <button class="attendance__btn">退勤</button>
        </form>
      </div>
    @endif

    @if ($status === '休憩中')
      
        <form method="POST" action="{{ route('attendance.breakout') }}">
            @csrf
            <button class="attendance__btn">休憩戻</button>
        </form>
    @endif

    @if (session('message'))
        <p class="attendance__message">
            {{ session('message') }}
        </p>
    @endif

</main>
</main>
    
</body>
</html>