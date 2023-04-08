function getEndTime(myYear){
        var myEndTime = new Date(''+myYear+'/06/27 14:00:00');
        return myEndTime;
    }

    function countDown(){
        var mydate = new Date();
        var year = '2023';
        var EndTime = getEndTime(year);
        var NowTime = new Date();
        if( (EndTime.getTime() - NowTime.getTime() ) < 0){
            year = mydate.getFullYear() + 1;
            EndTime = getEndTime(year);
        }
        var t = EndTime.getTime() - NowTime.getTime();



        var d=Math.floor(t/1000/60/60/24);
        var h=Math.floor(t/1000/60/60%24);
        var m=Math.floor(t/1000/60%60);
        var s=Math.floor(t/1000%60);

        document.getElementById('day').innerText = d;
        document.getElementById('hour').innerText = h;
        document.getElementById('minute').innerText = m;
        document.getElementById('second').innerText = s;
    } 
    setInterval(countDown,1000);