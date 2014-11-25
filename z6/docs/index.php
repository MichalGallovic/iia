<!DOCTYPE html><html><head><meta charset="utf-8"><title>Meniny, Sviatky, Pamätné dni API</title><link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"><link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,700|Inconsolata|Raleway:200"><style>/* Highlight.js Theme Tomorrow */
.hljs-comment,.hljs-title{color:#8e908c}.hljs-variable,.hljs-attribute,.hljs-tag,.hljs-regexp,.ruby .hljs-constant,.xml .hljs-tag .hljs-title,.xml .hljs-pi,.xml .hljs-doctype,.html .hljs-doctype,.css .hljs-id,.css .hljs-class,.css .hljs-pseudo{color:#c82829}.hljs-number,.hljs-preprocessor,.hljs-pragma,.hljs-built_in,.hljs-literal,.hljs-params,.hljs-constant{color:#f5871f}.ruby .hljs-class .hljs-title,.css .hljs-rules .hljs-attribute{color:#eab700}.hljs-string,.hljs-value,.hljs-inheritance,.hljs-header,.ruby .hljs-symbol,.xml .hljs-cdata{color:#718c00}.css .hljs-hexcolor{color:#3e999f}.hljs-function,.python .hljs-decorator,.python .hljs-title,.ruby .hljs-function .hljs-title,.ruby .hljs-title .hljs-keyword,.perl .hljs-sub,.javascript .hljs-title,.coffeescript .hljs-title{color:#4271ae}.hljs-keyword,.javascript .hljs-function{color:#8959a8}.hljs{display:block;background:white;color:#4d4d4c;padding:.5em}.coffeescript .javascript,.javascript .xml,.tex .hljs-formula,.xml .javascript,.xml .vbscript,.xml .css,.xml .hljs-cdata{opacity:.5}</style><style>body,
h4,
h5 {
  font-family: 'Roboto' sans-serif !important;
}
h1,
h2,
h3,
.aglio {
  font-family: 'Raleway' sans-serif !important;
}
h1 a,
h2 a,
h3 a,
h4 a,
h5 a {
  display: none;
}
h1:hover a,
h2:hover a,
h3:hover a,
h4:hover a,
h5:hover a {
  display: inline;
}
code {
  color: #444;
  background-color: #ddd;
  font-family: 'Inconsolata' monospace !important;
}
a[data-target] {
  cursor: pointer;
}
h4 {
  font-size: 100%;
  font-weight: bold;
  text-transform: uppercase;
}
.back-to-top {
  position: fixed;
  z-index: 1;
  bottom: 0px;
  right: 24px;
  padding: 4px 8px;
  background-color: #eee;
  text-decoration: none !important;
  border-top: 1px solid rgba(0,0,0,0.1);
  border-left: 1px solid rgba(0,0,0,0.1);
  border-right: 1px solid rgba(0,0,0,0.1);
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
}
.panel {
  overflow: hidden;
}
.panel-heading code {
  margin-left: 3px;
  color: #c7254e;
  background-color: rgba(255,255,255,0.7);
  white-space: pre-wrap;
  white-space: -moz-pre-wrap;
  white-space: -pre-wrap;
  white-space: -o-pre-wrap;
  word-wrap: break-word;
}
.panel-heading h3 {
  margin-top: 10px;
  margin-bottom: 10px;
}
a.list-group-item:hover {
  background-color: #f8f8f8;
  border-left: 2px solid #555;
  padding-left: 15px;
}
.indent {
  display: block;
  text-indent: 16px;
}
.list-group-item {
  padding-left: 16px;
}
.list-group-item .toggle .open {
  display: block;
}
.list-group-item .toggle .closed {
  display: none;
}
.list-group-item.collapsed .toggle .open {
  display: none;
}
.list-group-item.collapsed .toggle .closed {
  display: block;
}
a.list-group-item {
  font-size: 13px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
a.list-group-item.heading {
  font-size: 15px;
  background-color: #f5f5f5;
}
a.list-group-item.heading:hover {
  background-color: #f8f8f8;
}
.list-group-item.collapse {
  display: none;
}
.list-group-item.collapse.in {
  display: block;
}
.list-group-item a span.closed {
  display: none;
}
.list-group-item a span.open {
  display: block;
}
.list-group-item a.collapsed span.closed {
  display: block;
}
.list-group-item a.collapsed span.open {
  display: none;
}
#nav {
  width: inherit;
  margin-top: 38px;
  max-width: 255px;
  top: 0;
  bottom: 0;
  padding-right: 12px;
  padding-bottom: 12px;
  overflow-y: auto;
}
@media (max-width: 1199px) {
  #nav {
    max-width: 212px;
  }
}
</style></head><body><a href="#top" class="text-muted back-to-top"><i class="fa fa-toggle-up"></i>&nbsp;Back to top</a><div class="container"><div class="row"><div class="col-md-3"><nav id="nav" class="hidden-sm hidden-xs affix nav"><div class="list-group"><a data-toggle="" data-target="#meniny-menu" href="#meniny" class="list-group-item heading collapsed">Meniny</a><div id="meniny-menu"><a href="#meniny-meniny-list" style="border-top-left-radius: 0; border-top-right-radius: 0" class="list-group-item"><span class="badge alert-info"><i class="fa fa-arrow-down"></i></span>Meniny List</a><a href="#meniny-meniny-objekt" style="border-top-left-radius: 0; border-top-right-radius: 0" class="list-group-item"><span class="badge alert-info"><i class="fa fa-arrow-down"></i></span>Meniny Objekt</a><a href="#meniny-deň,-štát-list" style="border-top-left-radius: 0; border-top-right-radius: 0" class="list-group-item"><span class="badge alert-info"><i class="fa fa-arrow-down"></i></span>Deň, Štát List</a><a href="#meniny-deň-objekt" style="border-top-left-radius: 0; border-top-right-radius: 0" class="list-group-item"><span class="badge alert-info"><i class="fa fa-arrow-down"></i></span>Deň Objekt</a></div></div><div class="list-group"><a data-toggle="" data-target="#sviatky-menu" href="#sviatky" class="list-group-item heading collapsed">Sviatky</a><div id="sviatky-menu"><a href="#sviatky-deň,-názov-list" style="border-top-left-radius: 0; border-top-right-radius: 0" class="list-group-item"><span class="badge alert-info"><i class="fa fa-arrow-down"></i></span>Deň, Názov List</a></div></div><div class="list-group"><a data-toggle="" data-target="#pamätné-dni-menu" href="#pamätné-dni" class="list-group-item heading collapsed">Pamätné dni</a><div id="pamätné-dni-menu"><a href="#pamätné-dni-deň,-názov-list" style="border-top-left-radius: 0; border-top-right-radius: 0" class="list-group-item"><span class="badge alert-info"><i class="fa fa-arrow-down"></i></span>Deň, Názov List</a></div></div><p style="text-align: center; word-wrap: break-word;"><a href="http://vmxgallovicm.fei.stuba.sk/z6/api/v1">http://vmxgallovicm.fei.stuba.sk/z6/api/v1</a></p></nav></div><div class="col-md-8"><div><header><div class="page-header"><h1 id="top">Meniny, Sviatky, Pamätné dni API</h1></div></header><div class="description"><p>Toto je dokumentácia pre API vytvorenú na predmet IIA 2014 - STU FEI Bratislava, Michal Gallovič</p>
</div></div><div><div class="panel panel-default"><div class="panel-heading"><h3 id="meniny">Meniny&nbsp;<a href="#meniny"><i class="fa fa-link"></i></a></h3></div><div class="panel-body"><h4 id="meniny-meniny-list">Meniny List&nbsp;<a href="#meniny-meniny-list"><i class="fa fa-link"></i></a></h4><section id="meniny-meniny-list-get" class="panel panel-info"><div class="panel-heading"><div style="float:right"><span style="text-transform: lowercase">GET meniny</span></div><div style="float:left"><a href="#meniny-meniny-list-get" class="btn btn-xs btn-primary">GET</a></div><div style="overflow:hidden"><code>/meniny</code></div></div><div class="panel-body"><p>Všetky meniny vo všetkých štátoch zoskupené na základe dátumu.</p>
</div><ul class="list-group"><li class="list-group-item"><strong>Response&nbsp;&nbsp;<code>200</code></strong><a data-toggle="collapse" data-target="#4b9e489b777cca484a2f4e0715d8bc3e" class="pull-right collapsed"><span class="closed">Show</span><span class="open">Hide</span></a></li><li id="4b9e489b777cca484a2f4e0715d8bc3e" class="list-group-item panel-collapse collapse"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span><br></code></pre><h5>Body</h5><pre><code>[
    {
        "<span class="hljs-attribute">day</span>": <span class="hljs-value"><span class="hljs-string">"0202"</span></span>,
        "<span class="hljs-attribute">sk_holiday</span>": <span class="hljs-value"><span class="hljs-string">""</span></span>,
        "<span class="hljs-attribute">sk_day</span>": <span class="hljs-value"><span class="hljs-string">""</span></span>,
        "<span class="hljs-attribute">cz_holiday</span>": <span class="hljs-value"><span class="hljs-string">""</span></span>,
        "<span class="hljs-attribute">sk</span>": <span class="hljs-value"><span class="hljs-string">"Erika, Erik"</span></span>,
        "<span class="hljs-attribute">sk_many</span>": <span class="hljs-value"><span class="hljs-string">"Erik, Erika, Aida"</span></span>,
        "<span class="hljs-attribute">cz</span>": <span class="hljs-value"><span class="hljs-string">"Nela"</span></span>,
        "<span class="hljs-attribute">hu</span>": <span class="hljs-value"><span class="hljs-string">"Karolina, Aida"</span></span>,
        "<span class="hljs-attribute">pl</span>": <span class="hljs-value"><span class="hljs-string">"Marii, Miroslawa"</span></span>,
        "<span class="hljs-attribute">at</span>": <span class="hljs-value"><span class="hljs-string">"Mariä Lichtmess"</span>
    </span>},
    {
        "<span class="hljs-attribute">day</span>": <span class="hljs-value"><span class="hljs-string">"0203"</span></span>,
        "<span class="hljs-attribute">sk_holiday</span>": <span class="hljs-value"><span class="hljs-string">""</span></span>,
        "<span class="hljs-attribute">sk_day</span>": <span class="hljs-value"><span class="hljs-string">""</span></span>,
        "<span class="hljs-attribute">cz_holiday</span>": <span class="hljs-value"><span class="hljs-string">""</span></span>,
        "<span class="hljs-attribute">sk</span>": <span class="hljs-value"><span class="hljs-string">"Blažej"</span></span>,
        "<span class="hljs-attribute">sk_many</span>": <span class="hljs-value"><span class="hljs-string">"Blažej, Celerín, Celerína"</span></span>,
        "<span class="hljs-attribute">cz</span>": <span class="hljs-value"><span class="hljs-string">"Blažej"</span></span>,
        "<span class="hljs-attribute">hu</span>": <span class="hljs-value"><span class="hljs-string">"Balázs"</span></span>,
        "<span class="hljs-attribute">pl</span>": <span class="hljs-value"><span class="hljs-string">"Blazeja, Oskara"</span></span>,
        "<span class="hljs-attribute">at</span>": <span class="hljs-value"><span class="hljs-string">"Blasius"</span>
    </span>}
    ...
] 
</code></pre></li></ul></section><h4 id="meniny-meniny-objekt">Meniny Objekt&nbsp;<a href="#meniny-meniny-objekt"><i class="fa fa-link"></i></a></h4><p>Meniny so všetkých štátov týkajúce sa konkrétneho dňa</p>
<section id="meniny-meniny-objekt-get" class="panel panel-info"><div class="panel-heading"><div style="float:right"><span style="text-transform: lowercase">GET meniny</span></div><div style="float:left"><a href="#meniny-meniny-objekt-get" class="btn btn-xs btn-primary">GET</a></div><div style="overflow:hidden"><code>/meniny/{day}/{month}</code></div></div><ul class="list-group"><li class="list-group-item bg-default"><strong>Parameters</strong></li><li class="list-group-item"><dl class="dl-horizontal"><dt>day</dt><dd><code>number</code>&nbsp;<span class="required">(required)</span>&nbsp;<span class="text-muted example"><strong>Example:&nbsp;</strong><span>31</span></span><p>Deň</p>
</dd><dt>month</dt><dd><code>number</code>&nbsp;<span class="required">(required)</span>&nbsp;<span class="text-muted example"><strong>Example:&nbsp;</strong><span>12</span></span><p>Mesiac</p>
</dd></dl></li></ul><ul class="list-group"><li class="list-group-item"><strong>Response&nbsp;&nbsp;<code>200</code></strong><a data-toggle="collapse" data-target="#e82e42cc295a7e1aa88b07fd4a1d49d0" class="pull-right collapsed"><span class="closed">Show</span><span class="open">Hide</span></a></li><li id="e82e42cc295a7e1aa88b07fd4a1d49d0" class="list-group-item panel-collapse collapse"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span><br></code></pre><h5>Body</h5><pre><code>{
    <span class="hljs-string">"sk"</span>: <span class="hljs-string">""</span>,
    <span class="hljs-string">"sk_many"</span>: <span class="hljs-string">""</span>, <span class="hljs-comment">// všetky mená, kt. sa oslavujú v daný deň</span>
    <span class="hljs-string">"cz"</span>: <span class="hljs-string">""</span>,
    <span class="hljs-string">"hu"</span>: <span class="hljs-string">"Fruzsina"</span>,
    <span class="hljs-string">"pl"</span>: <span class="hljs-string">"Mieszka, Mieczyslawa"</span>,
    <span class="hljs-string">"at"</span>: <span class="hljs-string">"Neujahr"</span>
}
</code></pre></li></ul></section><h4 id="meniny-deň,-štát-list">Deň, Štát List&nbsp;<a href="#meniny-deň,-štát-list"><i class="fa fa-link"></i></a></h4><section id="meniny-deň,-štát-list-get" class="panel panel-info"><div class="panel-heading"><div style="float:right"><span style="text-transform: lowercase">GET day, state</span></div><div style="float:left"><a href="#meniny-deň,-štát-list-get" class="btn btn-xs btn-primary">GET</a></div><div style="overflow:hidden"><code>/meniny{?name}</code></div></div><div class="panel-body"><p>Dátumy so štátmi, kde má daná osoba meniny.</p>
</div><ul class="list-group"><li class="list-group-item bg-default"><strong>Parameters</strong></li><li class="list-group-item"><dl class="dl-horizontal"><dt>name</dt><dd><code>string</code>&nbsp;<span class="required">(required)</span>&nbsp;<span class="text-muted example"><strong>Example:&nbsp;</strong><span>Peter</span></span><p>Vyhľadávanie na základe mena</p>
</dd></dl></li></ul><ul class="list-group"><li class="list-group-item"><strong>Response&nbsp;&nbsp;<code>200</code></strong><a data-toggle="collapse" data-target="#41c501ce21a3203a2ae983e5c80dbdea" class="pull-right collapsed"><span class="closed">Show</span><span class="open">Hide</span></a></li><li id="41c501ce21a3203a2ae983e5c80dbdea" class="list-group-item panel-collapse collapse"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span><br></code></pre><h5>Body</h5><pre><code>[
    {
        "<span class="hljs-attribute">day</span>": <span class="hljs-value"><span class="hljs-string">"0629"</span></span>,
        "<span class="hljs-attribute">state</span>": <span class="hljs-value"><span class="hljs-string">"sk"</span>
    </span>},
    {
        "<span class="hljs-attribute">day</span>": <span class="hljs-value"><span class="hljs-string">"0629"</span></span>,
        "<span class="hljs-attribute">state</span>": <span class="hljs-value"><span class="hljs-string">"at"</span>
    </span>}
]
</code></pre></li></ul></section><h4 id="meniny-deň-objekt">Deň Objekt&nbsp;<a href="#meniny-deň-objekt"><i class="fa fa-link"></i></a></h4><section id="meniny-deň-objekt-get" class="panel panel-info"><div class="panel-heading"><div style="float:right"><span style="text-transform: lowercase">GET day</span></div><div style="float:left"><a href="#meniny-deň-objekt-get" class="btn btn-xs btn-primary">GET</a></div><div style="overflow:hidden"><code>/meniny{?name}{&amp;state}</code></div></div><div class="panel-body"><p>Dátum, na základe mena a štátu.</p>
</div><ul class="list-group"><li class="list-group-item bg-default"><strong>Parameters</strong></li><li class="list-group-item"><dl class="dl-horizontal"><dt>name</dt><dd><code>string</code>&nbsp;<span class="required">(required)</span>&nbsp;<span class="text-muted example"><strong>Example:&nbsp;</strong><span>Peter</span></span><p>Vyhľadávanie na základe mena</p>
</dd><dt>state</dt><dd><code>string</code>&nbsp;<span>(optional)</span>&nbsp;<span class="text-muted example"><strong>Example:&nbsp;</strong><span>sk</span></span><p>Vyhľadávanie na základe štátu</p>
</dd></dl></li></ul><ul class="list-group"><li class="list-group-item"><strong>Response&nbsp;&nbsp;<code>200</code></strong><a data-toggle="collapse" data-target="#3b4a0da1e1f818fe14d86d1810a429b3" class="pull-right collapsed"><span class="closed">Show</span><span class="open">Hide</span></a></li><li id="3b4a0da1e1f818fe14d86d1810a429b3" class="list-group-item panel-collapse collapse"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span><br></code></pre><h5>Body</h5><pre><code>{
    "<span class="hljs-attribute">day</span>": <span class="hljs-value"><span class="hljs-string">"0629"</span> // mmdd format
</span>}
</code></pre></li></ul></section></div></div></div><div><div class="panel panel-default"><div class="panel-heading"><h3 id="sviatky">Sviatky&nbsp;<a href="#sviatky"><i class="fa fa-link"></i></a></h3></div><div class="panel-body"><h4 id="sviatky-deň,-názov-list">Deň, Názov List&nbsp;<a href="#sviatky-deň,-názov-list"><i class="fa fa-link"></i></a></h4><section id="sviatky-deň,-názov-list-get" class="panel panel-info"><div class="panel-heading"><div style="float:right"><span style="text-transform: lowercase">GET day, name</span></div><div style="float:left"><a href="#sviatky-deň,-názov-list-get" class="btn btn-xs btn-primary">GET</a></div><div style="overflow:hidden"><code>/sviatky{?state}</code></div></div><ul class="list-group"><li class="list-group-item bg-default"><strong>Parameters</strong></li><li class="list-group-item"><dl class="dl-horizontal"><dt>state</dt><dd><code>string</code>&nbsp;<span class="required">(required)</span>&nbsp;<p>Štát, ktorého sviatky zobrazujeme</p>
<p><strong>Choices:&nbsp;</strong><code>sk</code> <code>cz</code> </p></dd></dl></li></ul><ul class="list-group"><li class="list-group-item"><strong>Response&nbsp;&nbsp;<code>200</code></strong><a data-toggle="collapse" data-target="#4ef3a7f55c498d26e1b9ab0703d5c1d5" class="pull-right collapsed"><span class="closed">Show</span><span class="open">Hide</span></a></li><li id="4ef3a7f55c498d26e1b9ab0703d5c1d5" class="list-group-item panel-collapse collapse"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span><br></code></pre><h5>Body</h5><pre><code>[
    {
        "<span class="hljs-attribute">day</span>": <span class="hljs-value"><span class="hljs-string">"0101"</span></span>,
        "<span class="hljs-attribute">name</span>": <span class="hljs-value"><span class="hljs-string">"Deň vzniku Slovenskej republiky"</span>
    </span>},
    {
        "<span class="hljs-attribute">day</span>": <span class="hljs-value"><span class="hljs-string">"0106"</span></span>,
        "<span class="hljs-attribute">name</span>": <span class="hljs-value"><span class="hljs-string">"Zjavenie Pána (Traja králi a vianočný sviatok pravoslávnych kresťanov)"</span>
    </span>},
    {
        "<span class="hljs-attribute">day</span>": <span class="hljs-value"><span class="hljs-string">"0501"</span></span>,
        "<span class="hljs-attribute">name</span>": <span class="hljs-value"><span class="hljs-string">"Sviatok práce"</span>
    </span>}
    ...
]
</code></pre></li></ul></section></div></div></div><div><div class="panel panel-default"><div class="panel-heading"><h3 id="pamätné-dni">Pamätné dni&nbsp;<a href="#pamätné-dni"><i class="fa fa-link"></i></a></h3></div><div class="panel-body"><h4 id="pamätné-dni-deň,-názov-list">Deň, Názov List&nbsp;<a href="#pamätné-dni-deň,-názov-list"><i class="fa fa-link"></i></a></h4><section id="pamätné-dni-deň,-názov-list-get" class="panel panel-info"><div class="panel-heading"><div style="float:right"><span style="text-transform: lowercase">GET day, name</span></div><div style="float:left"><a href="#pamätné-dni-deň,-názov-list-get" class="btn btn-xs btn-primary">GET</a></div><div style="overflow:hidden"><code>/pamatne_dni{?state}</code></div></div><ul class="list-group"><li class="list-group-item bg-default"><strong>Parameters</strong></li><li class="list-group-item"><dl class="dl-horizontal"><dt>state</dt><dd><code>string</code>&nbsp;<span class="required">(required)</span>&nbsp;<p>Štát, ktorého pamätné dni zobrazujeme</p>
<p><strong>Choices:&nbsp;</strong><code>sk</code> </p></dd></dl></li></ul><ul class="list-group"><li class="list-group-item"><strong>Response&nbsp;&nbsp;<code>200</code></strong><a data-toggle="collapse" data-target="#640c2a981d9fb3448b05c49c36fab1b5" class="pull-right collapsed"><span class="closed">Show</span><span class="open">Hide</span></a></li><li id="640c2a981d9fb3448b05c49c36fab1b5" class="list-group-item panel-collapse collapse"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span><br></code></pre><h5>Body</h5><pre><code>[
    {
        <span class="hljs-string">"day"</span>: <span class="hljs-string">"0325"</span>, // mmdd format
        <span class="hljs-string">"name"</span>: <span class="hljs-string">"Deň zápasu za ľudské práva"</span>
    },
    {
        <span class="hljs-string">"day"</span>: <span class="hljs-string">"0413"</span>,
        <span class="hljs-string">"name"</span>: <span class="hljs-string">"Deň nespravodlivo stíhaných"</span>
    },
    {
        <span class="hljs-string">"day"</span>: <span class="hljs-string">"0504"</span>,
        <span class="hljs-string">"name"</span>: <span class="hljs-string">"Výročie úmrtia M.R. Štefánika"</span>
    },
    {
        <span class="hljs-string">"day"</span>: <span class="hljs-string">"0607"</span>,
        <span class="hljs-string">"name"</span>: <span class="hljs-string">"Výročie Memoranda národa slovenského"</span>
    }
    <span class="hljs-keyword">...</span>
]
</code></pre></li></ul></section></div></div></div></div></div></div><p style="text-align: center;" class="text-muted">Generated by&nbsp;<a href="https://github.com/danielgtaylor/aglio" class="aglio">aglio</a>&nbsp;on 25 Nov 2014</p><div id="localFile" style="display: none; position: absolute; top: 0; left: 0; width: 100%; color: white; background: red; font-size: 150%; text-align: center; padding: 1em;">This page may not display correctly when opened as a local file. Instead, view it from a web server.

</div></body><script src="//code.jquery.com/jquery-1.11.0.min.js"></script><script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script><script>(function() {
  if (location.protocol === 'file:') {
    document.getElementById('localFile').style.display = 'block';
  }

}).call(this);
</script><script>(function() {
  $('table').addClass('table');

}).call(this);
</script></html>