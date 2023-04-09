import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from 'react-redux';
import {
    decrement,
    increment,
    incrementByAmount,
    selectTeams,
    setTeams,
    updateTeams,
    generateFixtures,
    // getTeams
} from "../reducers/exampleReducer";
import { TeamsService } from "../services";
import {Link} from "react-router-dom";
// import {getTeams} from "../services/teams";

const Home = () => {
    // const [teams, setTeams] = useState({});
    // console.log(teams);
    // let teamsList = [];
    const dispatch = useDispatch();
    const teams = useSelector(selectTeams);
    // axios('http://jsonplaceholder.typicode.com/users').then(data => console.log(data.data));
    // axios('http://localhost:8000/api/get-teams').then(data => console.log(data.data));
    useEffect(() => {
        TeamsService.getTeams().then(data => {
            dispatch(setTeams(data));
            // let index = -1;
            // teamsList = data.data.map((team) => {
            //     index++;
            //
            //     return (
            //         <li key={index} className="list-group-item">{team.name}</li>
            //     );
            // });
        });
    }, [teams.whenToUpdateProp]);
    // console.log(teams);
    // TeamsService.getTeams().then(data => {
    //     console.log(data);
    //     // dispatch(setTeams(data));
    // });
    // const teams = useSelector(selectTeams);
    // console.log(teams);
    // useEffect(() => {
    //     // TeamsService.getTeams().then(data => console.log(data));
    //     dispatch(setTeams())
    // });
    let teamCount = 0;

    const teamsList = teams.map((team) => {
        teamCount ++;

        return (
            <li key={team.id} className="list-group-item text-start">{teamCount + '-) ' + team.name}</li>
        );
    });

    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card text-center">
                        <div className="card-header"><h2>Tournament Teams</h2></div>
                        <div className="card-body">
                            <h5>Total count: {teams.length}</h5>
                            <ul className="list-group">
                                {teamsList}
                            </ul>
                            <Link to="/generate-fixtures" className="btn btn-primary mt-3" onClick={() => dispatch(generateFixtures())}>Generate Fixtures</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Home;
