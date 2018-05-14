<section id="addMemberResponseSection" class="border border-success">

    <h2 class="text-danger text-center" id="addResponseTitle">Add Comment</h2>

    <div class = "row justify-content-center">

        <div class = "addResponseBlock">

            <div id="responseToComment" class="responseToComment" >

            </div>

            <form action="" method="post" id="addResponse" class = "addResponse " >

                <input type="hidden" name="parentId" id="parentId" value ="0">
                <input type="hidden" name="topicId" value="{{ $topic->id }}">


                <div class="form-group">
                    <label for="addResponseText">Put Your comment</label>
                    <textarea class="form-control " id="addResponseText" name = "addResponseText" rows="3"></textarea>

                    <div id="addResponseTextError" class="invalid-feedback">
                        please put something in the field
                    </div>
                </div>




                <button type="button" id = "addCustomResponse" class="btn btn-primary float-right">Make comment!</button>


            </form>

        </div>

    </div>

</section>