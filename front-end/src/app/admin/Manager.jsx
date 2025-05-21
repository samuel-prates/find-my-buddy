import { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import { useParams } from "react-router-dom";
import Layout from "../Layout";

const Manager = () => {
    const token = useSelector((state) => state.reducer?.value.token)
    const params = useParams();
    const [user, setUser] = useState([]);

    if (token) {
        const defaultHeader = {
            Authorization: `Bearer ${token}`
        }
        const fetchUser = async () => {
            const response = await fetch('/api/users/' + params.id, {
                method: 'GET',
                headers: { 'Content-Type': 'application/json', ...defaultHeader }
            });
            if (response.status < 400) {
                const body = await response.json();
                setUser(body);
                console.log(body, user);
            }
        }
        useEffect(() => {
            fetchUser();
        }, []);

    }

    return (
        <>
            <Layout>
                <div class="container">
                    <div class="col l3 m6 s12">
                        <h5>Id: {user.id} - {user.name} </h5>
                    </div>
                </div>
            </Layout>
        </>
    )
}

export default Manager;