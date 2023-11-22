<div id="initial-textarea" contenteditable="true" onclick="switchToRichTextEditor()">
            <div class="placeholder">Type here...</div>
        </div>
        <div class="controls">
            <button class="btn btn-light" onclick="toggleMode('visual')"><i class="fas fa-eye"></i></button>
            <button class="btn btn-light" onclick="toggleMode('code')"><i class="fas fa-code"></i></button>
            <button class="btn btn-light" onclick="execCmd('bold')"><i class="fas fa-bold"></i></button>
            <button class="btn btn-light" onclick="execCmd('italic')"><i class="fas fa-italic"></i></button>
            <button class="btn btn-light" onclick="execCmd('underline')"><i class="fas fa-underline"></i></button>
            <button class="btn btn-light" onclick="execCmd('insertOrderedList')"><i class="fas fa-list-ol"></i></button>
            <button class="btn btn-light" onclick="execCmd('insertUnorderedList')"><i class="fas fa-list-ul"></i></button>
            <button class="btn btn-light" onclick="execCmd('justifyLeft')"><i class="fas fa-align-left"></i></button>
            <button class="btn btn-light" onclick="execCmd('justifyCenter')"><i class="fas fa-align-center"></i></button>
            <button class="btn btn-light" onclick="execCmd('justifyRight')"><i class="fas fa-align-right"></i></button>
            <button class="btn btn-light" onclick="execCmd('justifyFull')"><i class="fas fa-align-justify"></i></button>
            <select class="btn btn-light" onchange="execCmd('formatBlock', this.value)">
                <option value="P">Paragraph</option>
                <option value="H1">Heading 1</option>
                <option value="H2">Heading 2</option>
                <option value="H3">Heading 3</option>
                <option value="H4">Heading 4</option>
                <option value="H5">Heading 5</option>
                <option value="H6">Heading 6</option>
            </select>
            <select class="btn btn-light" onchange="execCmd('fontSize', this.value)">
                <option value="10px">10px</option>
                <option value="12px">12px</option>
                <option value="14px">14px</option>
                <option value="16px">16px</option>
                <option value="18px">18px</option>
                <option value="20px">20px</option>
                <option value="24px">24px</option>
                <option value="30px">30px</option>
                <option value="36px">36px</option>
                <option value="48px">48px</option>
                <option value="60px">60px</option>
                <option value="72px">72px</option>
                <option value="84px">84px</option>
                <option value="96px">96px</option>
                <option value="100px">100px</option>
            </select>
        </div>
        <textarea id="code-editor"></textarea>