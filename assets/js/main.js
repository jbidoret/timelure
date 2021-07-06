

var ajaxRequest = new (function () {

  function closeReq () {
    bIsLoading = false;
  }

  function abortReq () {
    if (!bIsLoading) { return; }
    xhr.abort();
    closeReq();
  }

  function ajaxError () {
    alert("Unknown error.");
  }

  function ajaxLoad(){
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        
        // parse answwer
        var res = xhr.responseText;
        var parser = new DOMParser;
        var doc = parser.parseFromString(res, "text/html")
        var fragment = doc.querySelector('main');
        oPageInfo.title = doc.querySelector('title').textContent;
        var year = fragment.dataset.year;

        //
        document.title = oPageInfo.title;
        
        if (bUpdateURL) {
          console.log(oPageInfo, oPageInfo.title, oPageInfo.url);
          history.pushState(oPageInfo, oPageInfo.title, oPageInfo.url);
          bUpdateURL = false;
        }
        
        // append
        var target = document.getElementById("annee-" + year + "-content");
        target.appendChild(fragment);
        target.classList.add('visible');
        
        // scroll
        target.scrollIntoView({ behavior: 'smooth' });

        // close button
        var close = document.createElement('button');
        target.querySelector('header').appendChild(close);
        close.textContent = "×";
        close.addEventListener('click', function(e){
          e.stopPropagation();
          target.removeChild(fragment);
          document.querySelector('.opened').classList.remove('opened');
        });
      } else {
        console.error(xhr.statusText);
      }
    }
    closeReq();
  }

  function getPage (sPage) {
    if (bIsLoading) { return; }
    xhr = new XMLHttpRequest();
    bIsLoading = true;
    xhr.onload = ajaxLoad;
    xhr.onerror = ajaxError;
    if (sPage) { oPageInfo.url = sPage; }
    xhr.open("get", oPageInfo.url, true);
    xhr.send();
  }

  function requestPage (sURL) {
    if (history.pushState) {
      bUpdateURL = true;
      getPage(sURL);
    } else {
      /* Ajax navigation is not supported */
      location.assign(sURL);
    }
  }

  function processLink () {
    if (this.classList.contains(sAjaxClass)) {
      if(!this.matches('.opened')){
        this.classList.add("opened");
        requestPage(this.href);
      } 
      return false;
    }
    return true;
  }

  function init () {
    oPageInfo.title = document.title;
    for (var oLink, nIdx = 0, nLen = document.links.length; nIdx < nLen; document.links[nIdx++].onclick = processLink);
  }

  var sAjaxClass = "event-link",
    oPageInfo = {
      title: null,
      url: location.href
    },
    xhr, 
    bIsLoading = false, 
    bUpdateURL = false;

  onpopstate = function (oEvent) {
    bUpdateURL = false;
    oPageInfo.title = oEvent.state.title;
    oPageInfo.url = oEvent.state.url;
    getPage();
  };

  window.addEventListener ? addEventListener("load", init, false) : window.attachEvent ? attachEvent("onload", init) : (onload = init);
  this.open = requestPage;
  this.stop = abortReq;
  this.rebuildLinks = init;
  
})();
