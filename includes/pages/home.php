<a id="commit" target="_blank" href="https://github.com/ShtHappens796/Shor10">
    <span><?=$shor10->getCommitHash()?></span>
</a>
<form id="shorten">
    <a href="/"><h5>SHOR10.ME</h5></a>
    <h6>Just another URL shortener.</h6>
    <input id="input" name="url" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Insert long URL here">
    <input id="result" class="invis" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" readonly></input>
    <button id="submit-btn" type="submit">SHORTEN</button>
    <button id="copy-btn" class="invis" type="button">COPY</button>
    <span id="error" class="invis"></span>
</form>
