<style>
    .searchbox{
        float:right;
        margin: 10px;
        
    }
    .searchbox input, .searchbox button{
        border-radius: 15px;
        
    }

    .searchbox input{
        padding: 10px;
        font-size: 17px;
        border: 2px solid  #190061;
        float: left;
        width: 80%;
        background: #f1f1f1;
    }

    .searchbox button{
        padding: 10px;
        font-size: 17px;
        border: 2px solid #190061;
        float: left;
        width: 15%;
        background: #f1f1f1;
        margin-left: 5px;
    }

</style>


<div class="searchbox">
    <form action="lists.php" method="get">
    <input type="search" name="search" id="search" placeholder="Search for a book">
    <input type="hidden" name="type" value="4">
    <button type="submit">Go</button>
    </form>
</div>