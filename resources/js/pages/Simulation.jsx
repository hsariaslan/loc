import React, {useState} from 'react';
import {useDispatch, useSelector} from 'react-redux';
import {
    selectLeagueTable,
    selectMatchesOfWeek,
    selectChampionshipPredictions,
    setLeagueTable,
    setMatchesOfWeek,
    updateMatchesOfWeek,
    setChampionshipPredictions,
    selectFixtures,
    setFixtures
} from "../reducers/rootReducer";
import {LeagueTableService, FixturesService} from "../services";

const Simulation = () => {
    const dispatch = useDispatch();
    const [week, setWeek] = useState(1);
    let leagueTable = useSelector(selectLeagueTable);
    let matchesOfWeek = useSelector(selectMatchesOfWeek);
    let championshipPredictions = useSelector(selectChampionshipPredictions);

    if (leagueTable.length === 0) {
        LeagueTableService.getLeagueTable().then(data => {
            dispatch(setLeagueTable(data));
        });
    }

    if (matchesOfWeek.length === 0) {
        FixturesService.getMatchesOfWeek(week).then(data => {
            dispatch(setMatchesOfWeek(data));
        });
    }

    let i = 0;

    const matchesOfWeekTr = matchesOfWeek.map((teamsOfMatch) => {
        i++;

        return (
            <tr key={i}>
                <td scope="row" align="right">{teamsOfMatch.home_team?.name ?? 'free this round'}</td>
                <td scope="row"
                    align="center">{`${teamsOfMatch.home_team_score ?? ''} -  ${teamsOfMatch.away_team_score ?? ''}`}</td>
                <td scope="row" align="left">{teamsOfMatch.away_team?.name ?? 'free this round'}</td>
            </tr>
        );
    })

    const playAllWeeks = () => {
        FixturesService.playAllWeeks(week).then(data => {
            LeagueTableService.getLeagueTable().then(data => {
                dispatch(setLeagueTable(data));
            });
            dispatch(setFixtures(data.fixtures));
            setWeek(week + 1);
            FixturesService.getMatchesOfWeek(week + 1).then(data => {
                dispatch(updateMatchesOfWeek(data));
            });
        });
    }

    const playNextWeek = () => {
        FixturesService.playMatchesOfWeek(week).then(data => {
            LeagueTableService.getLeagueTable().then(data => {
                dispatch(setLeagueTable(data));
            });
            dispatch(setFixtures(data.fixtures));
            setWeek(week + 1);
            FixturesService.getMatchesOfWeek(week + 1).then(data => {
                dispatch(updateMatchesOfWeek(data));
            });
        });
    }

    const resetData = () => {
        setWeek(1);
        FixturesService.resetData().then(data => {
            dispatch(setLeagueTable(data.leagueTable));
            dispatch(setFixtures(data.fixtures));
            FixturesService.getMatchesOfWeek(week).then(data => {
                dispatch(setMatchesOfWeek(data));
            });
        });
    }

    i = 0;

    const leagueTableTr = leagueTable.map((row) => {
        i++;

        return (
            <tr key={row.id}>
                <td scope="row">{i}</td>
                <td scope="row" align="left">{`${row.team?.name} (${row.team?.strength})`}</td>
                <td>{row.games}</td>
                <td>{row.wins}</td>
                <td>{row.draws}</td>
                <td>{row.loses}</td>
                <td>{row.goal_difference}</td>
                <td><b className="text-primary">{row.point}</b></td>
            </tr>
        );
    });

    i = 0;

    const championshipPredictionsTr = leagueTable.map((championshipPrediction) => {
        i++;

        return (
            <tr key={i}>
                <td scope="row" align="left">{championshipPrediction.team.name}</td>
                <td scope="row" align="right">{championshipPrediction.championship_prediction}</td>
            </tr>
        );
    });

    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card text-center">
                        <div className="card-header"><h2>Simulation</h2></div>
                        <div className="card-body">
                            <button className="btn btn-outline-primary mt-3" onClick={() => playAllWeeks()}>Play All Weeks</button>
                            <button className="btn btn-primary mt-3 mx-3" onClick={() => playNextWeek()}>Play Next Week</button>
                            <button className="btn btn-danger mt-3" onClick={() => resetData()}>Reset Data</button>
                            <div className="row mt-4">
                                <div className="col-md-5">
                                    <table className="table">
                                        <thead className="bg-black text-white">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" align="left">Team</th>
                                            <th scope="col">G</th>
                                            <th scope="col">W</th>
                                            <th scope="col">D</th>
                                            <th scope="col">L</th>
                                            <th scope="col">GD</th>
                                            <th scope="col">P</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {leagueTableTr}
                                        </tbody>
                                    </table>
                                </div>
                                <div className="col-md-4">
                                    <table className="table">
                                        <thead className="bg-black text-white">
                                        <tr>
                                            <th scope="col" align="left" colSpan="3">Week {week}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {matchesOfWeekTr}
                                        </tbody>
                                    </table>
                                </div>
                                <div className="col-md-3">
                                    <table className="table">
                                        <thead className="bg-black text-white">
                                        <tr>
                                            <th scope="col" align="left">Championship Predictions</th>
                                            <th scope="col" align="right">%</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {championshipPredictionsTr}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Simulation;
