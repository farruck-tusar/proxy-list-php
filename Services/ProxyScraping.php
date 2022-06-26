<?php

require_once '../Vendor/autoload.php';
class ProxyScraping
{

    public function scraping_proxy_list($url)
    {
        // init
        $return = [];

        // create HTML DOM
        $dom = \voku\helper\HtmlDomParser::file_get_html($url);

        //Find the table data
        $table = $dom->find('table',0);
        foreach($table->find('tr') as $row) {
            // initialize array to store the cell data from each row
            $proxyList = array();
            foreach($row->find('td') as $cell) {
                // push the cell's text to the array
                $proxyList[] = $cell->plaintext;
            }
            if(count($proxyList)>0)
                $proxyListRowData[] = $proxyList;
        }

        foreach($proxyListRowData as $key=> $cell)
        {
            $scrappedData[$key]["ip"] = $cell[0];
            $scrappedData[$key]["port"] = $cell[1];;
            $scrappedData[$key]["code"] = $cell[2];;
            $scrappedData[$key]["country"] = $cell[3];;
            $scrappedData[$key]["provider"] = $cell[4];;
            $scrappedData[$key]["https"] = $cell[6];
            $scrappedData[$key]["last_checked"] = $cell[7];
        }
        return $scrappedData;
    }

 
    public function getScrapedData()
    {

        $ssl_proxies= $this->scraping_proxy_list('https://www.sslproxies.org/');

        $socks_proxy = $this->scraping_proxy_list('https://www.socks-proxy.net/');

        $free_proxy = $this->scraping_proxy_list('https://free-proxy-list.net/');

       

        // $us_proxy[]  = $this->scraping_proxy_list('https://www.us-proxy.org/');

        // $uk_proxy  = $this->scraping_proxy_list('https://free-proxy-list.net/uk-proxy.html');
        $data = array_merge($ssl_proxies, $socks_proxy, $free_proxy);

       return $data;
    }
    


    
    // -----------------------------------------------------------------------------
}
