<!doctype html>
<?php






/*
 *
 *
 * add these? https://lifehacker.com/5971715/five-custom-searches-you-should-enable-in-your-browser-right-now
 *
 *
 * NOTE: only works on root directory in chrome!!!!!
 * use subdomains?
 *
 *
 *
 */












$host = 'http'.(@$_SERVER['HTTPS']=='on'?'s://':'//').$_SERVER['HTTP_HOST'];

$data = explode('/',trim($_SERVER['REQUEST_URI'],"/ \t\n\r\0"));
array_walk($data, function(&$value) {
    $value = html_entity_decode($value);
});
$openSearch = [
    'GoogleRecent'       => $host.'/search/GoogleRecent.xml',
    'BrokerBin'          => $host.'/search/brokerbin.xml',
    'BrokerBin.com'      => 'http://members.brokerbin.com/search2.xml',
];

$data[0]='BrokerBin.com';
?>
<html>
<head profile="http://a9.com/-/spec/opensearch/1.1/">
    <meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8"/>
    <title>OpenSearch</title>
    <?php

    if(isset($openSearch[$data[0]])){
        echo "<link rel=\"search\" href=\"{$openSearch[$data[0]]}\" type=\"application/opensearchdescription+xml\" title=\"Artistan: {$data[0]}\"/>";
    }

    ?>

</head>
<body>
<h1>OpenSearch</h1>

<?php

foreach($openSearch as $key=>$val){
    echo "<a href='/$key'>$key</a><br/>";
}

?>

</body>
</html>