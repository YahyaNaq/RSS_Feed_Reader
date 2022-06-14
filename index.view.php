<?php require 'xml.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="assets\YahyaNmini.png" type="image/png"/>
  	<script src="https://cdn.tailwindcss.com"></script>
	<title>RSS Feed Reader</title>
</head>
<body class="bg-gradient-to-l from-gray-700 to-gray-800">
    <div class="flex justify-between mx-[92px]">
       <div>
	       <h1 class="text-blue-200 text-[2.5rem] mt-4 font-bold">RSS Feed Reader</h1>
	       <h3 class="text-white text-[1.18rem] mb-4 font-light">Get your favourite articles on one page</h3>   
       </div>
       <img src="assets\YahyaN.png" class="h-[8rem] w-auto">
    </div>
    <form method='post' class="mx-[92px] mb-4">
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input name="url" type="url" id="search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Drop RSS feed url here" required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Feed</button>
        </div>
    </form>
    <?php
    if (isset($_POST['url'])) {
        $url=$_POST['url'];
        $xml=xml::CheckUrl($url);
    }
    ?>
    <?php if (isset($xml) and $xml):?>
    <div class="flex flex-wrap justify-center gap-x-4">
        <?php foreach ($xml->channel->item as $item):
            $article= new xml($item); 
            $image=$xml->channel->image->url;
            ?>
        <div class="mb-4 max-w-xl px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800 hover:scale-[1.025] duration-100" style="cursor: auto;">
            <a href="<?= $article->art_link ?>" target="_blank">
              <div class="flex justify-between align-start">
                  <div class="mt-2 mb-2">
                    <h1 class="text-base text-gray-500"><?= $article->date ?></h1>
                    <?php if(strlen($article->title)>58): ?>
                        <h2 class="text-[1.6rem] font-bold text-gray-700 dark:text-white dark:hover:text-gray-200"><?= $article->title."..." ?></h2>
                    <?php else: ?>
                        <h2 class="text-[1.6rem] font-bold text-gray-700 dark:text-white dark:hover:text-gray-200"><?= $article->title ?></h2>
                    <?php endif; ?>
                  </div> 
                  <img src="<?= $image ?>" class="w-auto h-20">
              </div>
              <p class="text-gray-600 dark:text-gray-300"><?= $article->description ?></p>
              <div class="flex align-end justify-end mt-4">
                <a href="<?= $article->art_link ?>" target='_blank' class="text-blue-700 dark:text-blue-400 hover:font-medium">Read more ⟶</a> 
              </div>
            </a>
        </div>
        <?php endforeach ?>
    </div>
    <?php elseif(isset($_POST["url"])) : ?>
        <div class="flex flex-col align-center mt-12">
            <img src="assets\articles_illustration.svg" class="w-auto h-64">
            <h1 class="text-blue-200 text-[1.8rem] mt-4 font-medium text-center uppercase">Oops!</h1>
            <h1 class="text-blue-200 text-[1.6rem] font-medium text-center uppercase">invalid url for an rss feed.</h1>
        </div>
    <?php else: ?>
        <div class="flex flex-col align-center mt-12">
            <img src="assets\articles_illustration.svg" class="w-auto h-64">
            <h1 class="text-blue-200 text-[1.8rem] mt-4 font-medium text-center uppercase">Hey There!</h1>
            <h1 class="text-blue-200 text-[1.6rem] font-light text-center uppercase">Search your favourite articles.</h1>
        </div>
    <?php endif; ?> 
</body>
</html>
