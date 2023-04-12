import React, {useEffect} from 'react';
import {useDispatch, useSelector} from 'react-redux';
import {
    selectTeams,
    setTeams,
} from "../reducers/rootReducer";
import {TeamsService} from "../services";
import {Link} from "react-router-dom";

const Home = () => {
    const dispatch = useDispatch();
    const teams = useSelector(selectTeams);

    useEffect(() => {
        TeamsService.getTeams().then(data => {
            dispatch(setTeams(data));
        });
    }, [teams.whenToUpdateProp]);

    let teamCount = 0;

    const teamsList = teams.map((team) => {
        teamCount++;

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
                            <Link to="/generate-fixtures" className="btn btn-primary mt-3">Generate Fixtures</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Home;
