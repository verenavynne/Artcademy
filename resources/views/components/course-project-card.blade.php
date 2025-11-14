<div class="projek-card d-flex flex-column">
    <div class="projek-header d-flex flex-row">
        <p class="projek-name">{{ $project->projectName }}</p>
        <img src="{{ asset('assets/icons/icon_arrow_down.svg') }}" alt="Arrow Icon" class="arrow-icon" width="24" height="24" style="">
    </div>

    <div class="projek-content d-flex flex-column">
        <div class="d-flex flex-column" style="gap: 16px;">
            <div class="projek-konsep d-flex flex-column">
                <p class="projek-title-section">Konsep</p>
                <p>{{ $project->projectConcept }}</p>
            </div>
            <div class="projek-requirement d-flex flex-column">
                <p class="projek-title-section">Requirement</p>
                <p>{{ $project->projectRequirement }}</p>
            </div>

            <div class="projek-tools d-flex flex-column">
                <p class="projek-title-section">Tools</p>

               
                <div class="tools-list-container d-flex flex-row"> 
                     @foreach ($projectTools as $projectTool )
                     <div class="tools-container d-flex flex-row">
                         <img class="tool-icon" src="{{ asset($projectTool->tool->toolsPicture) }}" alt="ToolIcon" height="35" width="35">
                         <p class="tool-name">{{ $projectTool->tool->toolsName }}</p>
                     </div>
                
                    @endforeach
        
                </div>
            
            </div>

            <div class="projek-kriteria d-flex flex-column">
                <p class="projek-title-section">Kriteria penilaian</p>
                @foreach ($projectCriterias as $projectCriteria)
                <div class="projek-kriteria-list d-flex flex-row align-items-center gap-1">
                    <img src="{{ asset('assets/icons/icon_checklist_kriteria_nilai.svg') }}" alt="checklist icon" width="16" height="11">
                    <p>{{$projectCriteria->criteria->criteriaName}} ({{ $projectCriteria->customWeight }}%)</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<style>
    .projek-card{
        background: white;
        border-radius: 40px;
        box-shadow: 0 4px 8px 0 var(--brown-shadow-color);
        padding-block: 40px;
        padding-inline: 38px;
        gap: 16px;
        margin: 0 6px;
        transition: all 0.4s ease;
    }

    .projek-card.hide{
        gap: 0px;
    }

    .projek-name{
        margin: 0;
        font-size: var(--font-size-big);
        color: var(--black-color);
        font-weight: 700;
    }

    .projek-title-section{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
        font-weight: 700;
    }

    .projek-header{
        align-items: center;
        align-self: stretch;
        justify-content: space-between;
        cursor: pointer;
    }

    .projek-content{
        max-height: 1000px;
        transition: all 0.4s ease;
    }

    .projek-card.hide .projek-content {
        max-height: 0; 
        overflow: hidden;
    }

     .tools-list-container{
        gap: 80px;

    }

    .tools-container{
        gap: 8px;
        justify-content: start;
        align-items: center;
    }

    .tool-icon{
        border-radius: 10px;
    }

    .tool-name{
        margin: 0;
        color: var(--dark-gray-color);
        font-size: var(--font-size-primary);
    }

    .projek-card p{
        margin: 0;
        font-size: var(--font-size-primary);
        color: var(--dark-gray-color);
    }

    .projek-card.hide {
        display: flex;
    }

    .arrow-icon {
        transition: transform 0.3s ease;
    }

    .projek-card.hide .arrow-icon {
        transform: rotate(180deg);
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const projekHeader = document.querySelector('.projek-header');
        projekHeader.addEventListener("click", function(){
            const projekSection = this.closest('.projek-card');

            projekSection.classList.toggle("hide");
        })
    })
</script>