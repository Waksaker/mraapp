<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Audio</title>
</head>
<body>

    <button id="playButton">Play Audio</button>
    <br>
    <audio id="audioPlayer" controls style="display: none;">
        <source src="{{ asset('storage/mp3/bhXL4B00j3Q.webm') }}" type="audio/webm">
        Your browser does not support the audio element.
    </audio>

    <script>
        document.getElementById("playButton").addEventListener("click", function() {
            let audio = document.getElementById("audioPlayer");
            audio.style.display = "block"; // Tampilkan kontrol audio
            audio.play();
        });
    </script>

</body>
</html>
