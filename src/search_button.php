<style>
    .searchbox{
        float:right;
        margin: 10px;
    }
    .searchbox input, .searchbox button{
        border-radius: 15px;
    }

</style>


<div class="searchbox">
    <form action="lists.php" method="get">
    <input type="search" name="search" id="search" placeholder="Search for a book">
    <input type="hidden" name="type" value="4">
    <button type="submit">Go</button>
    </form>
</div>