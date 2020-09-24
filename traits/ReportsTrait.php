<?php
trait ReportsTrait{
	public function getReportData($method){
        $sql = $this->$method();
        return query($sql);
	}

    public function getTeams(){
        $sql = "SELECT * FROM team";
        return $sql;
    }

    public function best_3pt_shooter(){
        $sql = "SELECT 
                roster.name as player_name, 
                team.name as team_name, 
                age, 
                pos as position, 
                3pt, 
                3pt_attempted, 
                concat(round((3pt/3pt_attempted * 100), 2), '%') as 3pt_percentage 
            FROM 
                player_totals 
            JOIN 
                roster 
            ON 
                roster.id = player_totals.player_id 
            JOIN 
                team 
            ON 
                team.code = roster.team_code 
            WHERE 
                (3pt/3pt_attempted * 100) > 35 
            ORDER BY 
                (3pt/3pt_attempted * 100) 
            DESC";
        return $sql;
    }

    public function best_3pt_shooting_team(){
        $sql = "SELECT 
                team_code, 
                team.name, 
                SUM(3pt) as team_3pt_made, 
                SUM(3pt_attempted) as team_3pt_attempts, 
                concat(round((SUM(3pt)/SUM(3pt_attempted) * 100 ), 2), '%') as team_3pt_percentage, 
                SUM(case when 3pt >= 1 then 1 else 0 end) as number_of_contributing_players_with_at_least_1_3pt, 
                SUM(case when 3pt_attempted >= 1 then 1 else 0 end) as player_with_at_least_1_3pt_attempt,
                SUM(case when 3pt = 0 then 3pt_attempted else 0 end) as total_number_of_3pt_attempts_made_by_players_who_failed_to_make_a_3pt 
            FROM 
                roster 
            JOIN 
                player_totals 
            ON 
                player_totals.player_id = roster.id 
            JOIN 
                team
            ON
                team.code = roster.team_code 
            GROUP BY 
                team_code 
            ORDER BY 
                team_3pt_percentage 
            DESC";
        return $sql;
    }
}