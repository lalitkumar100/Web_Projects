let currentsong = new Audio();
async function getsongs(){
    let song= await fetch("http://127.0.0.1:5500/playlist_songs/");
    let response = await song.text();
    let div=document.createElement("div");
    div.innerHTML=response;
    let as=div.getElementsByTagName('a');

    let songs=[];

    for (let index = 0; index < as.length; index++) {
        const element = as[index];
        if(element.href.endsWith('.mp3')){
            songs.push(element.href);
        }      
    }
    return songs;
}



function secondsToMinutesSeconds(seconds) {
    if (isNaN(seconds) || seconds < 0) {
        return "00:00";
    }

    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);

    const formattedMinutes = String(minutes).padStart(2, '0');
    const formattedSeconds = String(remainingSeconds).padStart(2, '0');

    return `${formattedMinutes}:${formattedSeconds}`;
}



async function getsongs_Name(){
    let song= await fetch("http://127.0.0.1:5500/playlist_songs/");
    let response = await song.text();
    let div=document.createElement("div");
    div.innerHTML=response;
    let as=div.getElementsByTagName('a');

    let songs=[];

    for (let index = 0; index < as.length; index++) {
        const element = as[index];
        if(element.href.endsWith('.mp3')){
            let x=element.href.split("/playlist_songs/")[1];
            songs.push(x.split(".mp3")[0]);
        }      
    }
    return songs;
}



function playaudio(track,player=false){
    currentsong.src="/playlist_songs/"+track;
    if(!player){
        currentsong.play();
        play.src="buttons/pause-button.svg";
    }
        document.querySelector(".songDuration").innerHTML="00:00 / 00:00";
        document.querySelector(".songName").innerHTML=decodeURI(track);      
}




async function main(){
    let songs_Name = await getsongs_Name();

    

    let songUL=document.querySelector('.songlist').getElementsByTagName('ul')[0];
    for (const song of songs_Name) {
        songUL.innerHTML = songUL.innerHTML+`<li>
                <img src="buttons/music.svg" class="invert" alt="">
                <div class="songInfo">
                  <div>${song.replaceAll('%20'," ")}</div>
                </div>
                <div class="playsong">Play Song</div>
                <img class="invert" src="buttons/play-circle.svg" alt="">
              </li>`;
    }



    let song = await getsongs();

    playaudio(songs_Name[0]+".mp3",true);


   Array.from(document.querySelector(".songlist").getElementsByTagName("li")).forEach((e)=>{
    e.addEventListener("click",async ()=>{
        playaudio(e.querySelector(".songInfo").firstElementChild.innerHTML+".mp3");
    })
   })




   play.addEventListener("click",()=>{
    if(currentsong.paused){
        currentsong.play();
        play.src="buttons/pause-button.svg";
    }
    else{
        currentsong.pause();
        play.src="buttons/play-button.svg"
    }
   })



   currentsong.addEventListener("timeupdate",()=>{
        document.querySelector(".songDuration").innerHTML=`${secondsToMinutesSeconds(currentsong.currentTime)+" / "+secondsToMinutesSeconds(currentsong.duration)}`;
        document.querySelector(".circle").style.left = (currentsong.currentTime/currentsong.duration)*100 + "%";
   })


   document.querySelector(".rangeslider").addEventListener("click",(e)=>{
            var percent = (e.offsetX/e.target.getBoundingClientRect().width)*100;
            document.querySelector(".circle").style.left = percent + "%";
            currentsong.currentTime = (percent*currentsong.duration)/100;
   })


   

}




main();