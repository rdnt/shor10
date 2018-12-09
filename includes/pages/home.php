<div id="header">
    <span>Commit: <span id="hash"><?=$shor10->getCommitHash()?></span> - </span>
    <a target="_blank" rel="noopener" href="https://github.com/ShtHappens796/Shor10">Source Code</a></span>
</div>
<form id="shorten">
    <a class="title" href="/"><h5>
        <span class="white">SHOR10</span><span class="black">.ME</span>
    </h5></a>
    <h6>Just another URL shortener.</h6>
    <input id="input" name="url" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Insert long URL here">
    <input id="result" class="invis" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" readonly></input>
    <button id="submit-btn" type="submit">SHORTEN</button>
    <button id="copy-btn" class="invis" type="button">COPY</button>
    <span id="error" class="invis">asd</span>
</form>
