import React, {useState} from 'react';
import {useSelector} from "react-redux";
import {selectMatchesOfWeek, selectFixtures} from "../reducers/rootReducer";

function Week() {
    let fixtures = useSelector(selectFixtures);
    let matchesOfWeek = useSelector(selectMatchesOfWeek);
    const [week, setWeek] = useState(1);
    let i = 0;

    console.log(fixtures);
    {fixtures.map((weeks) => {
        i++;
        return (
            <table className="table">
                <thead className="bg-black text-white">
                <tr>
                    <th scope="col" colSpan="3">Week {week}</th>
                </tr>
                </thead>
                <tbody>
                {weeks.map((teamsOfMatch) => {
                    i++;
                    return (
                        <tr key={i}>
                            <td scope="row" align="right">{teamsOfMatch.home_team?.name ?? 'free this round'}</td>
                            <td scope="row"
                                align="center">{`${teamsOfMatch.home_team_score ?? ''} -  ${teamsOfMatch.away_team_score ?? ''}`}</td>
                            <td scope="row" align="left">{teamsOfMatch.away_team?.name ?? 'free this round'}</td>
                        </tr>
                    );
                })}
                </tbody>
            </table>
        );
    })}
}

export default Week;
